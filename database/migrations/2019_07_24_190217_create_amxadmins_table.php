<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAmxadminsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amxadmins', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('username', 32)->unique();
            $table->string('password', 50)->nullable();
            $table->string('access', 32)->nullable();
            $table->string('flags', 32)->nullable();
            $table->string('steamid', 32)->unique();
            $table->string('nickname', 32)->unique();
            $table->string('icq', 9)->nullable();
            $table->integer('ashow')->nullable();
            $table->integer('created')->nullable();
            $table->integer('expired')->nullable();
            $table->integer('days')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('amxadmins');
    }
}
