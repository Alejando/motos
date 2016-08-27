<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBills extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills_infos', function ($table) {
            $table->increments('id')->unsigned();
            $table->string('rfc', 128);
            $table->string('business_name', 255);
            $table->string('address', 125);
            $table->string('neighborhood', 50);
            $table->string('postal_code', 50);
            $table->string('city', 50);
            $table->string('state', 50);
            $table->integer('user_id')->unsigned();
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
        Schema::drop('bills_infos');
    }
}
