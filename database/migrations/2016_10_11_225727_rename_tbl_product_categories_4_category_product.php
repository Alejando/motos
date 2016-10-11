<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameTblProductCategories4CategoryProduct extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::rename('products_categories','category_product');
        Schema::table('category_product', function(Blueprint $table) {
            $table->renameColumn('categories_id', 'category_id');
            $table->renameColumn('products_id', 'product_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('category_product', function(Blueprint $table) {
            $table->renameColumn('category_id', 'categories_id');
            $table->renameColumn('product_id', 'products_id');
        });
        Schema::rename('category_product', 'products_categories');
    }
}
