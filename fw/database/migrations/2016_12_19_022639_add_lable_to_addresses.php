<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLableToAddresses extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('addresses', function(Blueprint $table){
            $table->string("label");
            $table->string("tel");
            $table->string("first_name");
            $table->string("last_name");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('addresses', function(Blueprint $table){
            $table->dropColumn('label');
            $table->dropColumn("tel");
            $table->dropColumn("first_name");
            $table->dropColumn("last_name");
        });
    }

}
