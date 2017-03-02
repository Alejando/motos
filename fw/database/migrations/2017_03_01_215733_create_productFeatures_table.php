<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_features', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('value');
            $table->integer('n_order');
            $table->timestamps();
            $table->integer('product_id')->unsigned();
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
            $table->integer('type_product_feature_id')->unsigned();
            $table->foreign('type_product_feature_id')
                ->references('id')
                ->on('type_product_features')
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
        Schema::table('product_features', function(Blueprint $table){
            $table->dropForeign('product_features_product_id_foreign');
        });
        Schema::table('product_features', function(Blueprint $table){
            $table->dropForeign('product_features_type_product_feature_id_foreign');
        });
        Schema::drop('product_features');
    }
}
