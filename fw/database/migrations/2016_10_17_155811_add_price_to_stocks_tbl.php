<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPriceToStocksTbl extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('stocks', function(Blueprint $table){
            $table->decimal('price');
            $table->string('code',20);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('stocks', function(Blueprint $table){
            $table->dropColumn('price');
            $table->dropColumn('code');
        });
    }

}
