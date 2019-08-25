<?php

use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $data = DB::connection('old')
            ->table('amxadmins')
            ->get();

        foreach ($data as $item) {
            $arrayItem = (array)$item;

            if (isset($arrayItem['buyadmin'])) {
                unset($arrayItem['buyadmin']);
            }

            if (isset($arrayItem['sb_code'])) {
                unset($arrayItem['sb_code']);
            }

            $model = new \App\Models\User($arrayItem);
            $model->save();
        }

        try {
            // для старого магазина импорт почты и уникальной ссылки
            $data = DB::connection('old')
                ->table('admins')
                ->get();

            foreach ($data as $item) {
                $user = User::where('username', $item->id)->first();

                if ($user === null) {
                    echo 'Пользователь с ' .  $item->id . ' не найден.<br>';
                } else {
                    $user->email = $item->email;
                    $user->auth_key = $item->auth_code;
                    try {
                        $user->save();
                    } catch (QueryException $e) {
                        echo 'Пользователь с ' . $item->id .' такими данными уже существует<br>';
                    }
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }

        foreach (User::all() as $user) {
            if ($user->flags === 'a') {
                $user->nickname = $user->username = $user->steamid;
                $user->save();
            }
        }
    }
}
