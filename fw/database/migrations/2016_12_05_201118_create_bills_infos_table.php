<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rfc');
            $table->string('business_name');
            $table->string('street');
            $table->string('streetNumber');
            $table->string('suiteNumber');
            $table->string('neighborhood');
            $table->integer('postal_code');
            $table->string('city');
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('state_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('state_id')->references('id')->on('states')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('bills_infos');
    }
}
