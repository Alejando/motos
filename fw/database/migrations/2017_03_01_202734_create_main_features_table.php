<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMainFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_features', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('n_order');
            $table->string('description');                        
            $table->timestamps();
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
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
        Schema::table('main_features', function (Blueprint $table) {
            $table->dropForeign('main_features_product_id_foreign');
        });

        Schema::drop('main_features');
    }
}
