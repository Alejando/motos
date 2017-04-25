<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSlidersAndSliderItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sliders', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->timestamps();
        });

        Schema::create('slider_items', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('title');
            $table->integer('n_order');
            $table->string('description');
            $table->string('link');
            $table->timestamps();
            $table->integer('sliders_id')->unsigned();
            $table->foreign('sliders_id')
                ->references('id')
                ->on('sliders')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('sliders');

        Schema::table('slider_items', function (Blueprint $table) {
            $table->dropForeign('slider_items_group_product_feature_id_foreign');
        });

        Schema::drop('slider_items');
    }
}
