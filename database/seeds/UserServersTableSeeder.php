<?php

use Illuminate\Support\Facades\DB;

class UserServersTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $data = DB::connection('old')
            ->table('admins_servers')
            ->get();

        foreach ($data as $item) {
            $server = \App\Models\Server::find($item->server_id);
            $user = \App\Models\User::find($item->admin_id);

            if ($server === null || $user === null) {
                continue;
            }

            if ($item->custom_flags !== 'yes' && !empty($item->custom_flags)) {
                $customFlags = $item->custom_flags;
            } else {
                $customFlags = $user->access;
            }

            if ($item->expire) {
                $expire = $item->expire;
            } else {
                if ($user->expired !== 0) {
                    $expire = date('Y-m-d H:i:s', $user->expired);
                } else {
                    $expire = null;
                }

            }

            $user->expired = 0;
            $user->days = 0;
            $user->save();

            $user->servers()->save($server, [
                'custom_flags' => $customFlags,
                'expire' => $expire,
                'use_static_bantime' => $item->use_static_bantime
            ]);
        }
    }
}
