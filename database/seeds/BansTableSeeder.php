<?php

use Illuminate\Support\Facades\DB;

class BansTableSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $data = DB::connection('old')
            ->table('bans')
            ->get();

        foreach ($data as $item) {
            $arrayItem = (array)$item;
            $model = new \App\Models\Ban($arrayItem);
            $model->save();
        }
    }
}
