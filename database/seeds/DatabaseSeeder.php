<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        DB::beginTransaction();
        $this->call(BansTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(ServersTableSeeder::class);
        $this->call(UserServersTableSeeder::class);
        DB::commit();
    }
}
