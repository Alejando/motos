<?php

use Illuminate\Database\Seeder;

class ColorsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //factory(DwSetpoint\Models\Color::class,10)->create();
        $items = [
            [//1
                'name'=>'Azul',
                'rgb'=>'#CCCCFF',
                'pref'=>'az'
            ],[//2
                'name'=>'Amarillo',
                'rgb'=>'#FFFF66',
                'pref'=>'am'
            ],[//3
                'name'=>'Rojo',
                'rgb'=>'#FF0000',
                'pref'=>'ro'
            ],[//4
                'name'=>'Verde',
                'rgb'=>'#00CC00',
                'pref'=>'ve'
            ],[//5
                'name'=>'Azul Marino',
                'rgb'=>'#0000FF',
                'pref'=>'az'
            ],[//6
                'name'=>'Rosa',
                'rgb'=>'#FF33FF',
                'pref'=>'ro'
            ],[//7
                'name'=>'Gris',
                'rgb'=>'#A0A0A0',
                'pref'=>'gr'
            ],[//8
                'name'=>'Negro',
                'rgb'=>'#000000',
                'pref'=>'ne'
            ],[//9
                'name'=>'Blanco',
                'rgb'=>'#ffffff',
                'pref'=>'bl'
            ],[//10
                'name'=>'Naranja',
                'rgb'=>'#FF8000',
                'pref'=>'na'
            ],[//11
                'name'=>'Morado',
                'rgb'=>'#6600CC',
                'pref'=>'mo'
            ]
        ];
        foreach($items as $item){
            DwSetpoint\Models\Color::create($item);
        }
    }
}
