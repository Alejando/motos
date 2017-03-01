<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddGroupProductFeatureToProductTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_product_features', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
        });

        Schema::table('product_types', function (Blueprint $table) {
            $table->integer('group_product_feature_id')->unsigned();
            $table->foreign('group_product_feature_id')
                ->references('id')
                ->on('group_product_features')
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
        Schema::drop('group_product_features');
        
        Schema::table('product_types', function (Blueprint $table) {
            $table->dropForeign('products_group_product_feature_id_foreign');
        });
    }
}
