<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddMinAmountGroupsPostalCodes extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('postal_code_groups', function(Blueprint $table){
            $table->decimal("amount_free");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('postal_code_groups', function(Blueprint $table){
            $table->dropColumn("amount_free");
        });
    }

}
