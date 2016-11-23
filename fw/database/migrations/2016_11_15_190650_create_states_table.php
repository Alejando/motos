<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStatesTable extends Migration
{
    public function up()
    {
        //
        Schema::create('states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->integer('country_id')->unsigned()->nullable();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
        });       
  
        $states = [
            [
                'name' => 'Aguascalientes',
                'country_id' => 1
            ],
            [
                'name' => 'Baja California Norte',
                'country_id' => 1
            ],
            [
                'name' => 'Baja California Sur',
                'country_id' => 1
            ],
            [
                'name' => 'Campeche',
                'country_id' => 1
            ],
            [
                'name' => 'Chiapas',
                'country_id' => 1
            ],
            [
                'name' => 'Chihuahua',
                'country_id' => 1
            ],
            [
                'name' => 'Coahuila',
                'country_id' => 1
            ],
            [
                'name' => 'Colima',
                'country_id' => 1
            ],
            [
                'name' => 'Ciudad México',
                'country_id' => 1
            ],
            [
                'name' => 'Durango',
                'country_id' => 1
            ],
            [
                'name' => 'Guanajuato',
                'country_id' => 1
            ],
            [
                'name' => 'Guerrero',
                'country_id' => 1
            ],
            [
                'name' => 'Hidalgo',
                'country_id' => 1
            ],
            [
                'name' => 'Jalisco',
                'country_id' => 1
            ],
            [
                'name' => 'Estado de México',
                'country_id' => 1
            ],
            [
                'name' => 'Michoacán',
                'country_id' => 1
            ],
            [
                'name' => 'Morelos',
                'country_id' => 1
            ],
            [
                'name' => 'Nayarit',
                'country_id' => 1
            ],
            [
                'name' => 'Nuevo León',
                'country_id' => 1
            ],
            [
                'name' => 'Oaxaca',
                'country_id' => 1
            ],
            [
                'name' => 'Puebla',
                'country_id' => 1
            ],
            [
                'name' => 'Querétaro',
                'country_id' => 1
            ],
            [
                'name' => 'Quintana Roo',
                'country_id' => 1
            ],
            [
                'name' => 'San Luis Potosí',
                'country_id' => 1
            ],
            [
                'name' => 'Sinaloa',
                'country_id' => 1
            ],
            [
                'name' => 'Sonora',
                'country_id' => 1
            ],
            [
                'name' => 'Tabasco',
                'country_id' => 1
            ],
            [
                'name' => 'Tamaulipas',
                'country_id' => 1
            ],
            [
                'name' => 'Tlaxcala',
                'country_id' => 1
            ],
            [
                'name' => 'Veracruz',
                'country_id' => 1
            ],
            [
                'name' => 'Yucatán',
                'country_id' => 1
            ],
            [
                'name' => 'Zacatecas',
                'country_id' => 1
            ]
        ];

        DB::table('states')->insert($states);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::drop('states');
    }
}
