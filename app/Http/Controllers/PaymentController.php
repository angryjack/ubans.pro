<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Services\PaymentService;
use App\Services\ServerService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class PaymentController extends Controller
{
    /**
     * @var ServerService
     */
    private $serverService;

    /**
     * @var PaymentService
     */
    private $paymentService;

    /**
     * @var UserService
     */
    private $userService;

    public function __construct(ServerService $serverService, PaymentService $paymentService, UserService $userService)
    {
        $this->serverService = $serverService;
        $this->paymentService = $paymentService;
        $this->userService = $userService;
    }

    public function privilege()
    {
        $servers = $this->serverService->getWithPrivileges();
        return view('payment.privilege', compact('servers'));
    }

    /**
     * Создание платежа на оплату услуги и переход к платежу.
     */
    public function goPrivilege(Request $request)
    {
        $url = $this->paymentService->buyPrivilege($request);
        return response()->json(['url' => $url]);
    }

    public function donation(Request $request)
    {
        $url = $this->paymentService->makeDonation($request);
        return response()->json(['url' => $url]);
    }

    /**
     * Обработка ответа от платежной системы.
     */
    public function handle(Request $request)
    {
        try {
            $unitPay = new \UnitPay(env('UNITPAY_SECRET_KEY'));
            $unitPay->checkHandlerRequest();
            $result = $this->paymentService->handleUnitpayRequest($request);
            return $unitPay->getSuccessHandlerResponse($result);
        } catch (\Exception $e) {
            $errorMessage = $e->getMessage();
        } catch (\Throwable $e) {
            Log::error($e->getMessage());
            $errorMessage = 'Error logged';
        }
        return $unitPay->getErrorHandlerResponse($errorMessage);
    }

    public function showResult(Request $request)
    {
        $payment = $this->paymentService->getPaymentByIdAndAccount($request);
        if ($payment->type === Payment::TYPE_PRIVILEGE) {
            $user = $this->userService->getUserByPayment($payment);

            if (!isset($payment->data['show'])) {
                $data = $payment->data;
                $data['show'] = date('d.m.Y H:i');
                $payment->data = $data;
                $payment->save();
                return view('payment.results.buy', compact('user'));
            }

        } elseif ($payment->type === Payment::TYPE_PROLONG) {
            return view('payment.results.prolong');
        } elseif ($payment->type === Payment::TYPE_DONATION) {
            return view('payment.results.donation');
        }

        return redirect()->route('home');
    }
}
