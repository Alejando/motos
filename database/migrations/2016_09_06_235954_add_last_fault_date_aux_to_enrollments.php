<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLastFaultDateAuxToEnrollments extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::table('enrollments', function(Blueprint $table) {
            $table->dateTime("chekin_room");
            $table->datetime("last_fault_date_aux");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::table('enrollments', function(Blueprint $table) {
            $table->dropColumn("chekin_room");
            $table->dropColumn("last_fault_date_aux");
        });
    }

}
