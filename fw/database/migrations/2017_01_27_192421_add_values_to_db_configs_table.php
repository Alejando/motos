
<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddValuesToDbConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('d_b_configs')
            ->insert([
                        [
                        'code' => 'mapa-latitud',
                        'name' => 'Latitud Mapa',
                        'value' => '20.6306227',
                        'type' => 'double'
                        ],
                        [
                        'code' => 'mapa-longitud',
                        'name' => 'Longitud Mapa',
                        'value' => '-103.4426554',
                        'type' => 'double'
                        ],
                        [
                        'code' => 'mapa-zoom',
                        'name' => 'Zoom Mapa',
                        'value' => '14',
                        'type' => 'integer'
                        ]
                    ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('d_b_configs', function (Blueprint $table) {
            //
        });
    }
}
