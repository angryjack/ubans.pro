<?php

namespace App\Services\Payment;

use App\Models\Payment;

class PaymentResultDto
{
    /**
     * Уже оплачено.
     */
    public const STATE_SUCCESS = 'success';

    /**
     * Все готово к оплате.
     */
    public const STATE_READY = 'ready';

    /**
     * Оплачено.
     */
    public const STATE_PAY = 'pay';

    /**
     * Ошибка.
     */
    public const STATE_ERROR = 'error';

    public $status;
    public $message;

    /**
     * @var Payment
     */
    public $payment;
}
