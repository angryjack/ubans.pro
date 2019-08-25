<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Ban
 * @property $bid
 * @property $player_ip
 * @property $player_id
 * @property $player_nick
 * @property $admin_ip
 * @property $admin_id
 * @property $admin_nick
 * @property $ban_type
 * @property $ban_reason
 * @property $cs_ban_reason
 * @property $ban_created
 * @property $ban_length
 * @property $server_ip
 * @property $server_name
 * @property $ban_kicks
 * @property $expired
 * @property $imported
 */
class Ban extends Model
{
    public $timestamps = false;

    protected $primaryKey = 'bid';

    protected $fillable = [
        'bid',
        'player_ip',
        'player_id',
        'player_nick',
        'admin_ip',
        'admin_id',
        'admin_nick',
        'ban_type',
        'ban_reason',
        'cs_ban_reason',
        'ban_created',
        'ban_length',
        'server_ip',
        'server_name',
        'ban_kicks',
        'expired',
        'imported',
    ];

    public function getExpireAtAttribute()
    {
        switch ($this->ban_length) {
            case 0:
                $result = 'Навсегда';
                break;
            case -1:
                $result = 'Разбанен';
                break;
            default:
                $expireAt = $this->ban_created + $this->ban_length * 60;
                if ($expireAt < time()) {
                    $result = 'Разбанен';
                } else {
                    $result = date('d.m.Y H:i', $expireAt);
                }
        }
        return $result;
    }

    public function getIsActiveAttribute(): bool
    {
        if ($this->ban_length === 0) {
            $isActive = true;
        } elseif ($this->ban_length === -1) {
            $isActive = false;
        } else {
            $expireUnixTime = $this->ban_created + $this->ban_length * 60;
            if ($expireUnixTime < time()) {
                $isActive = false;
            } else {
                $isActive = true;
            }
        }
        return $isActive;

    }

    public function getCreatedAttribute()
    {
        return date('d.m.Y H:i', $this->ban_created);
    }
}
