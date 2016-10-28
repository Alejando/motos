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
                'pref'=>'azu'
            ],[//2
                'name'=>'Amarillo',
                'rgb'=>'#FFFF66',
                'pref'=>'ama'
            ],[//3
                'name'=>'Rojo',
                'rgb'=>'#FF0000',
                'pref'=>'roj'
            ],[//4
                'name'=>'Verde',
                'rgb'=>'#00CC00',
                'pref'=>'ver'
            ],[//5
                'name'=>'Azul Marino',
                'rgb'=>'#0000FF',
                'pref'=>'azm'
            ],[//6
                'name'=>'Rosa',
                'rgb'=>'#FF33FF',
                'pref'=>'ros'
            ],[//7
                'name'=>'Gris',
                'rgb'=>'#A0A0A0',
                'pref'=>'gri'
            ],[//8
                'name'=>'Negro',
                'rgb'=>'#000000',
                'pref'=>'neg'
            ],[//9
                'name'=>'Blanco',
                'rgb'=>'#ffffff',
                'pref'=>'bla'
            ],[//10
                'name'=>'Naranja',
                'rgb'=>'#FF8000',
                'pref'=>'nar'
            ],[//11
                'name'=>'Morado',
                'rgb'=>'#6600CC',
                'pref'=>'mor'
            ]
        ];
        foreach($items as $item){
            DwSetpoint\Models\Color::create($item);
        }
    }
}
