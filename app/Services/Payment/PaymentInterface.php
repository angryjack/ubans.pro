<?php

namespace App\Services\Payment;

use App\Models\Payment;
use Illuminate\Http\Request;

interface PaymentInterface
{
    /**
     * Подготавливает данные для оплаты и возвращает ссылку.
     *
     * @param Payment $payment
     * @param $description - описание платежа.
     * @return string - ссылка для перехода к оплате.
     */
    public function getUrl(Payment $payment, $description): string;

    /**
     * Обрабатывает запрос с платежной системы.
     *
     * @param Request $request
     * @return string
     */
    public function getPaymentResult(Request $request): PaymentResultDto;

    /**
     * Возвращает платеж по уникальному идентификатору.
     *
     * @param string $uid
     * @return Payment
     */
    public function getPaymentByUid(string $uid): Payment;
}
