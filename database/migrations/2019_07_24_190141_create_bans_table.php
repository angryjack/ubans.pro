<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bans', function (Blueprint $table) {
            $table->bigIncrements('bid');
            $table->string( 'player_ip', 32)->nullable();
            $table->string('player_id', 35)->nullable();
            $table->string( 'player_nick', 100)->default('Unknown');
            $table->string('admin_ip', 32)->nullable();
            $table->string( 'admin_id', 35)->default('Unknown');
            $table->string('admin_nick', 100)->default('Unknown');
            $table->string( 'ban_type', 10)->default('S');
            $table->string('ban_reason', 100)->nullable();
            $table->string( 'cs_ban_reason', 100)->nullable();
            $table->integer('ban_created')->nullable();
            $table->integer( 'ban_length')->nullable();
            $table->string('server_ip',32)->nullable();
            $table->string( 'server_name', 100)->default('Unknown');
            $table->integer('ban_kicks')->default(0);
            $table->integer( 'expired')->default(0);
            $table->integer('imported')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bans');
    }
}
