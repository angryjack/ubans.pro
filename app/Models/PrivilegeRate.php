<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class PrivilegeTerm
 * @property $id
 * @property $privilege_id
 * @property $price
 * @property $term
 */
class PrivilegeRate extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title',
        'privilege_id',
        'price',
        'term'
    ];

    public function privilege()
    {
        return $this->belongsTo(Privilege::class);
    }
}
