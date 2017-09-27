<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducationsUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educations_users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('degree');
            $table->integer('course_id')->unsigned();
            $table->string('college');
            $table->integer('start_date');
            $table->integer('end_date')->nullable();
            $table->integer('semester')->nullable();
            $table->string('crea_state')->nullable();
            $table->integer('crea_number')->nullable();
            $table->string('other_course')->nullable();            
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('educations_users');
    }
}
