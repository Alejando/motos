<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AgregaElCampoWinnernameEnAuction extends Migration
{
    public function up() {
        Schema::table('auctions', function(Blueprint $table){
            $table->string('winnername')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('auctions', function(Blueprint $table){
            $table->removeColumn('winnername');
        });
    }
}
