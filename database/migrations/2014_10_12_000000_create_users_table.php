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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->bigInteger('cpf')->nullable();
            $table->date('date_birth')->nullable();
            $table->bigInteger('cell_phone')->nullable();
            $table->bigInteger('phone')->nullable();
            $table->string('email',50)->unique();
            $table->string('user_name');
            $table->string('password');
            $table->boolean('is_company');
            $table->rememberToken();
            $table->boolean('status');
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
