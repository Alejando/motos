<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ChangeCodeAndCodebarFromProductToStock extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('products', function (Blueprint $table) {
            if(Schema::hasColumn('products', 'codebar')) {
                $table->dropColumn('codebar');
            }
            if(Schema::hasColumn('products', 'code')) {
                $table->dropColumn('code')->nullable();
            }
        });

        Schema::table('stocks', function (Blueprint $table) {
            $table->string('codebar', 15);
        });
        DwSetpoint\Models\Stock::get()->each(function($stock){
            $stock->codebar = uniqid();
            $stock->save();
        });
        Schema::table('stocks', function (Blueprint $table) {
            $table->string('codebar', 15)->unique()->change();
        });

        
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('stocks', function (Blueprint $table) {
            $table->dropColumn('codebar');
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('codebar', 15);
        });
        DwSetpoint\Models\Product::get()->each(function($product){
            $product->codebar = uniqid();
            $product->save();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('codebar', 15)->unique()->change();
        });

        Schema::table('products', function (Blueprint $table) {
            $table->string('code', 15);
        });
        DwSetpoint\Models\Product::get()->each(function($product){
            $product->code = uniqid();
            $product->save();
        });
        Schema::table('products', function (Blueprint $table) {
            $table->string('code', 15)->unique()->change();
        });
    }
}
