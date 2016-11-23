<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostalCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('postal_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('code');
            $table->integer('postal_code_group_id')->unsigned()->nullable();
            $table->foreign('postal_code_group_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('postal_codes');
    }
}
