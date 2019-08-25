<?php

namespace App\Services;

use App\Models\Donation;
use App\Models\Payment;

class DonationService
{
    public function getList()
    {
        return Donation::orderBy('amount', 'desc')->get();
    }

    /**
     * Добавление пожертвования после оплаты.
     *
     * @param Payment $payment
     * @return mixed
     * @throws \Exception
     */
    public function addDonation(Payment $payment)
    {
        $data = $payment->data;
        $requiredKeys = ['title', 'message', 'amount'];

        foreach ($requiredKeys as $key) {
            if (!isset($data[$key])) {
                throw new \Exception("Ошибка при создании пожертвования. Ключа $key нет в передаваемом массиве.");
            }
        }

        $donation = Donation::create([
            'title' => $data['title'],
            'message' => $data['message'],
            'amount' => $data['amount'],
        ]);

        return $donation;
    }
}
