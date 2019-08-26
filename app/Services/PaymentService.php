<?php

namespace App\Services;

use App\Models\Payment;
use App\Models\PrivilegeRate;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
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

    public function __construct()
    {
        $this->userService = app(UserService::class);
        $this->donationService = app(DonationService::class);
    }

    /**
     * Создает счет на покупку привилегии.
     *§
     * @param Request $request
     * @return string
     * @throws ValidationException
     */
    public function buyPrivilege(Request $request): string
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

            //todo проверка что пользователь не имеет других привилегий на этом сервере
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

        $payment = Payment::create([
            'type' => $paymentType,
            'data' => $data,
            'amount' => $rate->price,
            'account' => $accountPrefix . '-' . Str::random(9),
        ]);

        if ($paymentType === Payment::TYPE_PRIVILEGE) {
            $message = 'Покупка привилегии на ' . env('APP_NAME');
        } else {
            $message = 'Продление привилегии на ' . env('APP_NAME');
        }

        return $this->getPaymentUrl($payment, $message);
    }

    /**
     * Возвращает ссылку на оплату пожертвования.
     *
     * @param Request $request
     * @return string
     */
    public function makeDonation(Request $request)
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

        $payment = Payment::create([
            'type' => Payment::TYPE_DONATION,
            'data' => $data,
            'amount' => $amount,
            'account' => 'DONATION-' . Str::random(9),
        ]);

        $message = 'Пожертвование для ' . env('APP_NAME');

        return $this->getPaymentUrl($payment, $message);
    }

    /**
     * Обрабатывает ответ платежной системы.
     *
     * @param Request $request
     * @return string
     * @throws Exception
     */
    public function handleUnitpayRequest(Request $request)
    {
        $method = $request->input('method');
        $params = $request->input('params');
        $account = $params['account'];

        $payment = Payment::where('account', $account)->firstOrFail();
        if ($payment->status === Payment::STATUS_PAY) {
            return 'Оплата прошла успешно.';
        }

        $response = '';
        switch ($method) {
            case 'check':
                $this->checkOrderData($payment, $params);
                $payment->payment_id = $params['unitpayId'];
                $payment->status = Payment::STATUS_CHECK;
                $response = 'Проверка прошла успешно. Мы готовы принять Вашу оплату.';
                break;
            case 'pay':
                $payment->status = Payment::STATUS_PAY;

                switch ($payment->type) {
                    case Payment::TYPE_PRIVILEGE:
                        $this->userService->addPrivilege($payment);
                        break;
                    //case Payment::TYPE_EXTEND:
                    case Payment::TYPE_PROLONG:
                        $this->userService->prolongPrivilege($payment);
                        break;
                    case Payment::TYPE_DONATION:
                        $this->donationService->addDonation($payment);
                        break;
                }
                $response = 'Оплата произведена. Большое спасибо!';
                break;
            case 'error':
                $payment->status = Payment::STATUS_ERROR;
                $response = 'Произошла ошибка.';
                break;
        }
        $payment->save();

        return $response;
    }

    /**
     * Возвращает ссылку для оплаты.
     *
     * @param Payment $payment
     * @param $message
     * @return string
     */
    public function getPaymentUrl(Payment $payment, $message): string
    {
        return 'https://unitpay.ru/pay/' . env('UNITPAY_PUBLIC_KEY') .
            '?sum=' . $payment->amount .
            '&account=' . $payment->account .
            '&desc=' . $message .
            '&signature=' . $this->getFormSignature($payment, $message);
    }

    /**
     * Возвращает платеж по идентификатору и акаунту.
     *
     * @param Request $request
     * @return mixed
     */
    public function getPaymentByIdAndAccount(Request $request)
    {
        return Payment::where([
            ['payment_id', $request->input('paymentId')],
            ['account', $request->input('account')],
        ])->firstOrFail();
    }

    /**
     * Проверяет корректность данных заказа.
     *
     * @param Payment $payment
     * @param array $params
     * @throws Exception
     */
    private function checkOrderData(Payment $payment, array $params)
    {
        if ($payment->status === Payment::STATUS_CHECK) {
            if ($params['orderSum'] !== $payment->amount ||
                $params['account'] !== $payment->account ||
                $params['orderCurrency'] !== env('UNITPAY_CURRENCY') ||
                $params['projectId'] !== env('UNITPAY_PROJECT_ID')) {
                throw new Exception('Order validation Error!');
            }
        }
    }

    /**
     * Создает цифровую подпись.
     *
     * @param Payment $payment
     * @param $message
     * @return string
     */
    private function getFormSignature(Payment $payment, $message)
    {
        $hashStr = $payment->account . '{up}' .
            $message . '{up}' .
            $payment->amount . '{up}' .
            env('UNITPAY_SECRET_KEY');
        return hash('sha256', $hashStr);
    }
}
