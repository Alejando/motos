<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixProductSizeTbl extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::rename('products_sizes','product_size');
        Schema::table('product_size', function(Blueprint $table) {
            $table->dropForeign('products_sizes_products_id_foreign');
            $table->renameColumn('products_id', 'product_id');
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
        Schema::rename('product_size', 'products_sizes');
        Schema::table('products_sizes', function(Blueprint $table) {
            
            $table->dropForeign('product_size_product_id_foreign');
            $table->renameColumn('product_id', 'products_id');
            $table->foreign('products_id')
                ->references('id')
                ->on('categories');
        });
    }
}
