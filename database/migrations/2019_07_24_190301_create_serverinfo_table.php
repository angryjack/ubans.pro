<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateServerinfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serverinfo', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('timestamp')->nullable();
            $table->string('hostname', 100)->default('Unknown');
            $table->string('address', 100)->nullable();
            $table->string('gametype', 32)->nullable();
            $table->string('rcon', 32)->nullable();
            $table->string('amxban_version', 32)->nullable();
            $table->string('amxban_motd', 250)->nullable();
            $table->integer('motd_delay')->default(10);
            $table->integer('amxban_menu')->default(1);
            $table->integer('reasons')->nullable();
            $table->integer('timezone_fixx')->default(0);
            $table->text('description')->nullable();
            $table->text('rules')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('serverinfo');
    }
}
