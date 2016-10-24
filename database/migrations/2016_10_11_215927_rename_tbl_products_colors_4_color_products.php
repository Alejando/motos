<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTblProductsColors4ColorProducts extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::rename('products_colors','color_product');
        Schema::table('color_product', function(Blueprint $table) {
            $table->dropForeign('products_colors_products_id_foreign');
            $table->renameColumn('products_id', 'product_id');
            $table->foreign('product_id')
                ->references('id')
                ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('color_product', function(Blueprint $table) {
            $table->dropForeign('color_product_product_id_foreign');
            $table->renameColumn('product_id', 'products_id');
        });
        Schema::rename('color_product', 'products_colors');
        Schema::table('products_colors', function(Blueprint $table){
            $table->foreign('products_id')
                ->references('id')
                ->on('products');
        });
    }

}
