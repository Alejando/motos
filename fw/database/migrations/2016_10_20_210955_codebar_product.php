<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CodebarProduct extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('products', function (Blueprint $table) {
            $table->string('codebar', 15);
        });
        DwSetpoint\Models\Product::get()->each(function($product){
            $product->codebar=  uniqid();
            $product->save();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('codebar', 15)->unique()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('codebar');
        });

    }

}
