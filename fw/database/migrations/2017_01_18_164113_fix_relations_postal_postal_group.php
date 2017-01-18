<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FixRelationsPostalPostalGroup extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('postal_codes', function(Blueprint $table) {
            $table->dropForeign('postal_codes_postal_code_group_id_foreign');
        });
        Schema::table('postal_codes', function(Blueprint $table) {
            $table->foreign('postal_code_group_id')->references('id')
                ->on('postal_code_groups')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        //
    }

}
