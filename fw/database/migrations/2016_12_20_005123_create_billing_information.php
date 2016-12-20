<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingInformation extends Migration {
    
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('billing_information', function (Blueprint $table) {
            $table->increments('id');
            $table->string('rfc')->unique();
            $table->string('business_name');
            $table->string('street');
            $table->string('street_number');
            $table->string('suite_number');
            $table->string('neighborhood');
            $table->string('postal_code');
            $table->integer('user_id')->unsigned();
            $table->integer('country_id')->unsigned();
            $table->integer('state_id')->unsigned();
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
    public function down() {
        Schema::drop('billing_information');
    }
}
