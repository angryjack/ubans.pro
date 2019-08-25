<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

/**
 * Class User
 * @property $id
 * @property $username
 * @property $password
 * @property $access
 * @property $flags
 * @property $steamid
 * @property $nickname
 * @property $icq
 * @property $ashow
 * @property $created
 * @property $expired
 * @property $days
 * @property $role
 * @property $email
 * @property $auth_key
 *
 */
class User extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    public const ROLE_USER = 'user';
    public const ROLE_EDITOR = 'editor';
    public const ROLE_ADMIN = 'admin';
    public const ROLE_OWNER = 'owner';

    public const FLAG_NAME = 'a';
    public const FLAG_STEAM_ID = 'ce';

    public $timestamps = false;
    protected $table = 'amxadmins';

    protected $fillable = [
        'id',
        'username',
        'password',
        'access',
        'flags',
        'steamid',
        'nickname',
        'icq',
        'ashow',
        'created',
        //'expired',
        //'days',
        'role',
        'email',
        'auth_key',
    ];

    protected $guarded = [
        'password',
        'role',
    ];

    protected $hidden = [
        'password'
    ];

    public function servers()
    {
        return $this->belongsToMany(
            Server::class,
            'admins_servers',
            'admin_id',
            'server_id'
        )->withPivot(['custom_flags', 'expire']);
    }

    /**
     * Проверяет роль пользователя.
     * @param $role
     * @return bool
     */
    public function hasRole($role) {
        // для владельца доступно все
        return $this->role === self::ROLE_OWNER || $this->role === $role;
    }

    /**
     * Возвращает список типов доступа.
     * @return array
     */
    public function getFlagListAttribute()
    {
        return [
            self::FLAG_NAME => 'Ник + Пароль',
            self::FLAG_STEAM_ID => 'Steam ID',
        ];
    }

    /**
     * Возвращает список ролей.
     * @return array
     */
    public function getRoleListAttribute()
    {
        return [
            self::ROLE_USER => 'Юзер',
            self::ROLE_EDITOR => 'Редактор',
            self::ROLE_ADMIN => 'Админ',
            self::ROLE_OWNER => 'Владелец',
        ];
    }

    public function getPrivilegesAttribute()
    {
        $privileges = [];
        foreach ($this->servers as $server) {
            $privilege = Privilege::where([
                ['server_id', $server->id],
                ['flags', $server->pivot->custom_flags],
            ])->with('rates')->first();

            if ($server->pivot->expire === null) {
                $expire = 'Навсегда';
            } elseif (strtotime($server->pivot->expire) < time()) {
                $expire = 'Истекла';
            } else {
                $expire = date('d.m.Y H:i', strtotime($server->pivot->expire));
            }

            $privileges[] = [
                'server' => $server,
                'privilege' => $privilege,
                'flags' => $server->pivot->custom_flags,
                'expire' => $expire,
            ];
        }

        return $privileges;
    }
}
