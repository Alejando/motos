<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
        });

        $countries = [
            [
                'id' => 1,
                'name' => 'México',
            ]
        ];

        DB::table('countries')->insert($countries);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('countries');
    }
}
