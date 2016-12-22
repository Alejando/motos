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
            $table->dropForeign('products_categories_categories_id_foreign');
            $table->dropForeign('products_categories_products_id_foreign');

            $table->renameColumn('categories_id', 'category_id');
            $table->renameColumn('products_id', 'product_id');

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');

            $table->foreign('product_id')
                ->references('id')
                ->on('categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('category_product', function(Blueprint $table) {

            $table->dropForeign('category_product_category_id_foreign');
            $table->dropForeign('category_product_product_id_foreign');


            $table->renameColumn('category_id', 'categories_id');
            $table->renameColumn('product_id', 'products_id');

            $table->foreign('categories_id')
                ->references('id')
                ->on('categories');

            $table->foreign('products_id')
                ->references('id')
                ->on('products');
        });
        Schema::rename('category_product', 'products_categories');
    }
}
