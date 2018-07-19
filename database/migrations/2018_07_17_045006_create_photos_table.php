<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photos', function (Blueprint $table) {
          $table->increments('id');
          $table->string('user_id');
          $table->string('fbid');
          $table->string('fb_name');
          $table->string('descrition')->nullable();
          $table->string('image')->nullable();
          $table->string('w')->nullable();
          $table->string('h')->nullable();
          $table->integer('vote')->nullable();
          $table->integer('status')->nullable();
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
        Schema::dropIfExists('photos');
    }
}
