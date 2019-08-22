<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
        'description'
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
