<?php

namespace App\Services\Payment;

use App\Models\Payment;

class Faker implements PaymentInterface
{
    public function getUrl(Payment $payment, $message): string
    {
        return '';
    }

    public function validateOrder(Payment $payment, array $params): void
    {
        return true;
    }
}
