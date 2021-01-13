<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersProfileTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_profile', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            
            $table->date('birthday');
            $table->unsignedBigInteger('gender');
            $table->foreign('gender')->references('id')->on('genders')->onDelete('cascade');
            $table->unsignedBigInteger('marital');
            $table->foreign('marital')->references('id')->on('marital')->onDelete('cascade');

            $table->boolean('clients')->nullable();
            $table->boolean('boss')->nullable();


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
        Schema::dropIfExists('users_profile');
    }
}
