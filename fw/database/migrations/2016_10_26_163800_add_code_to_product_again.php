<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCodeToProductAgain extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('products', function (Blueprint $table) {
            $table->string('code', 15)->nullable();
        });
        DwSetpoint\Models\Product::get()->each(function($product){
            $product->code = uniqid();
            $product->save();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('code', 15)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('code');
        });

    }

}
