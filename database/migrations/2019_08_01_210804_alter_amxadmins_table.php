<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAmxadminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('amxadmins', function (Blueprint $table) {
            $table->string('role', 32)->default('user');
            $table->string('email', 191)->unique()->nullable();
            $table->string('auth_key', 191)->unique()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('amxadmins', function (Blueprint $table) {
            $table->dropColumn('role');
            $table->dropColumn('email');
            $table->dropColumn('auth_key');
        });
    }
}
