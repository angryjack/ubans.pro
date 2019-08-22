<?php

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
    }
}
