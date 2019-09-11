<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Server
 * @package App\Models
 * @property $id
 * @property $timestamp
 * @property $hostname
 * @property $address
 * @property $gametype
 * @property $rcon
 * @property $amxban_version
 * @property $amxban_motd
 * @property $motd_delay
 * @property $amxban_menu
 * @property $reasons
 * @property $timezone_fixx
 * @property $description
 * @property $rules
 */
class Server extends Model
{
    public $timestamps = false;

    protected $table = 'serverinfo';

    protected $fillable = [
        'id',
        'timestamp',
        'hostname',
        'address',
        'gametype',
        'rcon',
        'amxban_version',
        'amxban_motd',
        'motd_delay',
        'amxban_menu',
        'reasons',
        'timezone_fixx',
        'description',
        'rules'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'admins_servers', 'server_id', 'admin_id');
    }

    public function privileges()
    {
        return $this->hasMany(Privilege::class);
    }
}
