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

            $table->unsignedBigInteger('gender_id');
            $table->foreign('gender_id')->references('id')->on('genders')->onDelete('cascade');

            $table->unsignedBigInteger('marital_id');
            $table->foreign('marital_id')->references('id')->on('marital')->onDelete('cascade');

            $table->unsignedBigInteger('education_id');
            $table->foreign('education_id')->references('id')->on('educational_levels')->onDelete('cascade');

            $table->unsignedBigInteger('hiring_type_id');
            $table->foreign('hiring_type_id')->references('id')->on('hiring_types')->onDelete('cascade');

            $table->unsignedBigInteger('turn_id');
            $table->foreign('turn_id')->references('id')->on('turns')->onDelete('cascade');



            // $table->string('gender')->nullable();
            // $table->string('marital')->nullable();

            // $table->string('education')->nullable();
            $table->string('job')->nullable();
            $table->string('department')->nullable();
            // $table->string('hiring_type')->nullable();
            // $table->string('turn')->nullable();
            $table->string('rotation')->nullable();
            $table->string('current_work_experience')->nullable();
            $table->string('work_experience')->nullable();

            
            


            

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
