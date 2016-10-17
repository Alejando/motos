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
            $table->renameColumn('products_id', 'product_id');
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
            $table->renameColumn('product_id', 'products_id');
        });
    }
}
