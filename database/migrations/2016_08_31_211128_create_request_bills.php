<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRequestBills extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
         Schema::create('request_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rfc', 128);
            $table->string('business_name', 255);
            $table->string('address', 125);
            $table->string('neighborhood', 50);
            $table->string('postal_code', 50);
            $table->string('city', 50);
            $table->string('state', 50);
            $table->integer('type');
            $table->integer('user_id')->unsigned();
            $table->integer('enrollment_id')->unsigned()->nullable();
            $table->integer('auction_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('enrollment_id')->references('id')->on('enrollments');
            $table->foreign('auction_id')->references('id')->on('auctions');            
            $table->boolean('invoiced');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('request_bills');
    }

}
