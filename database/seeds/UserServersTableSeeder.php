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

            $user->servers()->save($server, [
                'custom_flags' => $item->custom_flags,
                'expire' => $item->expire,
                'use_static_bantime' => $item->use_static_bantime
            ]);
        }
    }
}
