<?php

use Illuminate\Support\Facades\DB;

class ServersTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $data = DB::connection('old')
            ->table('serverinfo')
            ->get();

        foreach ($data as $item) {
            $arrayItem = (array)$item;
            $model = new \App\Models\Server($arrayItem);
            $model->save();
        }
    }
}
