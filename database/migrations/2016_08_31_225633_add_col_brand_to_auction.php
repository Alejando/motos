<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColBrandToAuction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('auctions', function(Blueprint $table){
            $table->string('brand');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('auctions', function(Blueprint $table){
            $table->dropColumn('brand');
        });
    }
}
