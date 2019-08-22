<?php

namespace App\Services;

use App\Models\Donation;

class DonationService
{
    public function getList()
    {
        return Donation::orderBy('amount', 'desc')->get();
    }

    /**
     * Добавление пожертвования после оплаты.
     *
     * @param array $data
     * @return mixed
     * @throws \Exception
     */
    public function addDonation(array $data)
    {
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
