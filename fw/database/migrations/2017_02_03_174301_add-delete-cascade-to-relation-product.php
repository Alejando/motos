<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeleteCascadeToRelationProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('product_size', function(Blueprint $table){
            $table->dropForeign('product_size_product_id_foreign');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
        Schema::table('color_product', function(Blueprint $table){
            $table->dropForeign('color_product_product_id_foreign');
            $table->foreign('product_id')
                    ->references('id')
                    ->on('products')
                    ->onDelete('cascade');
        });
        Schema::table('items', function(Blueprint $table){
            $table->dropForeign('items_product_id_foreign');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
            ;
        });
        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_size', function(Blueprint $table) {
            $table->dropForeign('product_size_product_id_foreign');
            $table->foreign('product_id')
                ->references('id')
                ->on('products');
        });
        Schema::table('color_product', function(Blueprint $table) {
            $table->dropForeign('color_product_product_id_foreign');
            $table->foreign('product_id')
                    ->references('id')
                    ->on('products');
        });
        Schema::table('items', function(Blueprint $table) {
            $table->dropForeign('items_product_id_foreign');
            $table->foreign('product_id')
                ->references('id')
                ->on('products')
                ->onDelete('cascade');
        });
    }
}
