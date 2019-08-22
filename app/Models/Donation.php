<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ban
 * @property $id
 * @property $title
 * @property $message
 * @property $amount
 */
class Donation extends Model
{
    protected $fillable = [
        'title',
        'message',
        'amount'
    ];
}
