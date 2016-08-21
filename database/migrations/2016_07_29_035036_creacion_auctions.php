<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreacionAuctions extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create('auctions', function(Blueprint $table){
            $table->increments('id');
            
            $table->integer('category')->unsigned()->nullable();
            $table->integer('sub_category')->unsigned()->nullable();
            $table->integer('target');
            $table->string('code',15);
            $table->string('barcode',50);
            $table->string('title',150);
            $table->decimal('real_price');
            $table->decimal('cover');
            $table->decimal('min_offer');
            $table->decimal('max_offer');
            $table->integer('bids');
            $table->decimal('max_price');
            $table->integer('user_quota');
            $table->integer('users_limit');
            $table->integer('delay');
            $table->integer('max_user_quiet');
            $table->integer('death_time');
            $table->longText('description');
            $table->dateTime('start_env.serverdate');
            $table->dateTime('end_date');
            $table->boolean('published');
            $table->smallInteger('status');
            $table->integer('winner')->unsigned()->nullable();
            $table->integer('total_enrollments');
            $table->decimal('inflows');
            $table->decimal('sold_for');
            $table->decimal('last_offer');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::drop('auctions');
    }

}
