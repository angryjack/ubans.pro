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

    public function getCreatedAttribute()
    {
        if ($this->created_at !== null) {
            return $this->created_at->format('d.m.Y H:i');
        }
    }
}
