<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTypeProductFeaturesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('type_product_features', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('name');
            $table->string('description'); 
            $table->timestamps();
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
        Schema::table('type_product_features', function (Blueprint $table) {
            $table->dropForeign('type_product_features_group_product_feature_id_foreign');
        });

        Schema::drop('type_product_features');
    }
}
