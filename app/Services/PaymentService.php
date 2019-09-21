<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\PrivilegeRate;
use App\Services\Payment\PaymentInterface;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class PaymentService
{
    /**
     * @var UserService
     */
    private $userService;

    /**
     * @var DonationService
     */
    private $donationService;

    /**
     * @var PaymentInterface
     */
    private $payment;

    public function __construct()
    {
        $this->userService = app(UserService::class);
        $this->donationService = app(DonationService::class);
        $this->payment = app(PaymentInterface::class);
    }

    /**
     * Возвращает ссылку для оплаты.
     *
     * @param Request $request
     * @return string
     * @throws ValidationException
     */
    public function getUrl(Request $request): string
    {
        switch ($request->input('action')) {
            case Payment::TYPE_PRIVILEGE:
                return $this->buyPrivilegeOrder($request);
                break;
            case Payment::TYPE_DONATION:
                return $this->donationOrder($request);
                break;
        }

        abort(404);
    }

    /**
     * Возвращает результат обработки платежа.
     *
     * @param Request $request
     * @return string
     */
    public function handleRequest(Request $request)
    {
        $result = $this->payment->getPaymentResult($request);

        if ($result->status === $result::STATE_PAY) {
            switch ($result->payment->type) {
                case Payment::TYPE_PRIVILEGE:
                    $this->userService->addPrivilege($result->payment);
                    break;
                case Payment::TYPE_PROLONG:
                    $this->userService->prolongPrivilege($result->payment);
                    break;
                case Payment::TYPE_DONATION:
                    $this->donationService->addDonation($result->payment);
                    break;
            }
        }

        return $result->message;
    }

    /**
     * @param Request $request
     * @return View
     */
    public function getResultView(Request $request): View
    {
        $payment = $this->payment->getPaymentByRequest($request);

        switch ($payment->type) {
            case Payment::TYPE_PRIVILEGE:
                $user = $this->userService->getUserByPayment($payment);

                if (!isset($payment->data['show'])) {
                    $data = $payment->data;
                    $data['show'] = date('d.m.Y H:i');
                    $payment->data = $data;
                    $payment->save();
                    return view('payment.results.buy', compact('user'));
                }
            case Payment::TYPE_PROLONG:
                return view('payment.results.prolong');
                break;
            case Payment::TYPE_DONATION:
                return view('payment.results.donation');
                break;
            default:
                return redirect()->route('home');
        }
    }

    /**
     * Создает счет на покупку привилегии.
     *
     * @param Request $request
     * @return string
     * @throws ValidationException
     */
    private function buyPrivilegeOrder(Request $request): string
    {
        $this->userService->validateUserBeforePay($request);

        $rate = PrivilegeRate::find($request->input('rate'));

        // определяем тип покупки
        $paymentType = Payment::TYPE_PRIVILEGE;
        $accountPrefix = 'PRIVILEGE';

        // если пользователь авторизирован, разрешаем покупку и продление только по его данным.
        $user = $this->userService->getUserByAuth();
        if ($user === null) {
            $email = $request->input('email');
            $nickname = $request->input('nickname');
        } else {
            $email = $user->email;
            $nickname = $user->nickname;

            $activePrivilege = $user->servers()->where('id', $rate->privilege->server->id)->first();
            if ($activePrivilege) {
                if ($activePrivilege->pivot->custom_flags !== $rate->privilege->flags) {
                    throw new UnprocessableEntityHttpException('Нельзя купить несколько привилегий на одном сервере.');
                }
                if ($activePrivilege->pivot->expire === null) {
                    throw new UnprocessableEntityHttpException('Нельзя продлить привилегию которая была приобретена навсегда.');
                }
                // привилегия найдена и флаги совпадают - продление
                $paymentType = Payment::TYPE_PROLONG;
                $accountPrefix = 'PROLONG';
            }
        }

        $data = [
            'email' => $email,
            'nickname' => $nickname,
            'privilege_rate_id' => $rate->id,
        ];

        $payment = $this->createPayment($paymentType, $data, $rate->price, $accountPrefix);

        if ($paymentType === Payment::TYPE_PRIVILEGE) {
            $message = 'Покупка привилегии на ' . env('APP_NAME');
        } else {
            $message = 'Продление привилегии на ' . env('APP_NAME');
        }

        return $this->payment->getUrl($payment, $message);
    }

    /**
     * Возвращает ссылку на оплату пожертвования.
     *
     * @param Request $request
     * @return string
     */
    private function donationOrder(Request $request)
    {
        $amount = (int)$request->input('amount');

        if (!is_int($amount) || $amount < 10) {
            $amount = 250;
        }

        $title = $request->input('title', 'Аноним');
        $message = $request->input('message', '');

        $data = [
            'title' => $title,
            'message' => $message,
            'amount' => $amount,
        ];

        $payment = $this->createPayment(Payment::TYPE_DONATION, $data, $amount, 'DONATION');

        $message = 'Пожертвование для ' . env('APP_NAME');

        return $this->payment->getUrl($payment, $message);
    }

    private function createPayment(string $type, array $data, int $amount, string $prefix): Payment
    {
        $payment = Payment::create([
            'type' => Payment::TYPE_DONATION,
            'data' => $data,
            'amount' => $amount,
            'account' => $prefix . '-' . Str::random(9),
        ]);

        return $payment;
    }
}
