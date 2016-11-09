<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCouponsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coupons', function(Blueprint $table){
            $table->increments('id');
            $table->datetime('start_date');
            $table->datetime('expire_date')->nullable();
            $table->integer('uses_limit')->nullable();
            $table->string('code')->unique();
            $table->decimal('amount_min')->nullable();
            $table->integer('percent')->nullable();
            $table->decimal('discount')->nullable();
            $table->integer('type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('coupons');
    }
}
