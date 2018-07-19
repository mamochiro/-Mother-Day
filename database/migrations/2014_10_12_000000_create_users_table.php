<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::defaultStringLength(191);
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('fbid')->unique()->nullable();
            $table->string('fb_name')->unique()->nullable();
            $table->string('serial_id')->unique()->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('name')->unique()->nullable();
            $table->string('phone')->unique()->nullable();
            $table->string('address')->unique()->nullable();
            $table->string('password')->unique()->nullable();
            $table->string('created_ip')->unique()->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
