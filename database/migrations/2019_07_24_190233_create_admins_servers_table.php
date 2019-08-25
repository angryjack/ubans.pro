<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdminsServersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('admins_servers', function (Blueprint $table) {
            $table->unsignedInteger('admin_id')->default(0);
            $table->unsignedInteger('server_id')->default(0);
            $table->string('custom_flags', 32)->default('yes');
            $table->enum('use_static_bantime', ['yes', 'no'])->default('yes');
            $table->timestamp('expire')->nullable()->comment('срок истечения админов');
            $table->unique(['admin_id', 'server_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('admins_servers');
    }
}
