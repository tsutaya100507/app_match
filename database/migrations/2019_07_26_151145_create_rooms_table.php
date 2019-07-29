<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('send_user_id');
            $table->unsignedInteger('recieve_user_id');
            $table->unique(['send_user_id','recieve_user_id']);
            $table->timestamps();

            // 外部キー制約
            $table->foreign('send_user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('recieve_user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
