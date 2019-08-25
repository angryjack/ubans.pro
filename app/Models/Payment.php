<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property $type
 * @property $data
 * @property $amount
 * @property $account
 * @property $payment_id
 * @property $status
 */
class Payment extends Model
{
    public const STATUS_CHECK = 9;
    public const STATUS_PAY = 10;
    public const STATUS_ERROR = 0;

    public const TYPE_PRIVILEGE = 'privilege';
    //todo смена привилегии
    public const TYPE_EXTEND = 'extend';
    public const TYPE_PROLONG = 'prolong';
    public const TYPE_DONATION = 'donation';

    protected $fillable = [
        'type',
        'data',
        'amount',
        'account',
        'payment_id',
        'status',
    ];

    protected $casts = [
        'data' => 'array'
    ];
}
