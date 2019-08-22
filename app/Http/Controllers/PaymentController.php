<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use App\Services\ServerService;
use App\Services\UserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

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

    public function __construct(ServerService $serverService, PaymentService $paymentService)
    {
        $this->serverService = $serverService;
        $this->paymentService = $paymentService;
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
            //$unitPay->checkHandlerRequest();
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
}
