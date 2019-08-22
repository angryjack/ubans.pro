<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePrivilegeRatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('privilege_rates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedInteger('privilege_id');
            $table->integer('price');
            $table->integer('term');
            $table->index('privilege_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('privilege_rates');
    }
}
