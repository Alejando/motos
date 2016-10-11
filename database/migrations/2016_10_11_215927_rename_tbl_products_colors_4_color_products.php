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
            $table->renameColumn('products_id', 'product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('color_product', function(Blueprint $table) {
            $table->renameColumn('product_id', 'products_id');
        });
        Schema::rename('color_product', 'products_colors');
    }

}
