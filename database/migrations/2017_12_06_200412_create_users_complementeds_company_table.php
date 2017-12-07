<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersComplementedsCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users_complementeds_company', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('social_name');
            $table->bigInteger('cnpj');
            $table->binary('logo_company')->nullable();
            $table->string('responsible_engineer')->nullable();
            $table->string('crea_state')->nullable();
            $table->integer('crea_number')->nullable();
            $table->boolean('is_company_engineer');
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users_complementeds_company');
    }
}
