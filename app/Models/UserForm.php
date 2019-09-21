<?php

namespace App\Models;

use App\Services\ServerService;

class UserForm
{
    public $user;

    public $servers = [];

    public $privilegesOnServers = [];

    public function __construct(?User $user = null)
    {
        $this->user = $user ?: new User();

        $serverService = app()->make(ServerService::class);

        $this->servers = $serverService->getAllWithPrivileges();

        if ($user) {
            $user->password = '';
            foreach ($user->servers as $server) {
                $server->pivot->expire = date('d-m-Y', strtotime($server->pivot->expire));

                if($server->pivot->custom_flags === 'yes' || empty($server->pivot->custom_flags)) {
                    $server->pivot->custom_flags = $user->access;
                }

                $this->servers[$server->id] = $server;
            }
        }
    }
}
