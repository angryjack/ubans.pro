<?php

namespace App\Http\Controllers;

use App\Services\PaymentService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\View\View;
use Laravel\Lumen\Routing\Controller;

class PaymentController extends Controller
{
    /**
     * @var PaymentService
     */
    private $paymentService;

    public function __construct(PaymentService $paymentService)
    {
        $this->paymentService = $paymentService;
    }

    /**
     * Перенаправление на оплату.
     *
     * @param Request $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function redirect(Request $request)
    {
        $url = $this->paymentService->getUrl($request);
        return response()->json(['url' => $url]);
    }

    /**
     * Обработка результата оплаты.
     * Запрос производит платежная система.
     *
     * @param Request $request
     * @return string
     */
    public function handle(Request $request)
    {
        return $this->paymentService->handleRequest($request);
    }

    /**
     * Отображение результата оплаты пользователю.
     *
     * @param Request $request
     * @return View
     */
    public function result(Request $request)
    {
        return $this->paymentService->getResultView($request);
    }
}
