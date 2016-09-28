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
            [//0
                'color'=>'Sin color',
                'hex'=>'',
                'prefix'=>'sin'
            ],[//1
                'name'=>'Azul',
                'hex'=>'#CCCCFF',
                'prefix'=>'azu'
            ],[//2
                'name'=>'Amarillo',
                'hex'=>'#FFFF66',
                'prefix'=>'ama'
            ],[//3
                'name'=>'Rojo',
                'hex'=>'#FF0000',
                'prefix'=>'roj'
            ],[//4
                'name'=>'Verde',
                'hex'=>'#00CC00',
                'prefix'=>'ver'
            ],[//5
                'name'=>'Azul Marino',
                'hex'=>'#0000FF',
                'prefix'=>'azm'
            ],[//6
                'name'=>'Rosa',
                'hex'=>'#FF33FF',
                'prefix'=>'ros'
            ],[//7
                'name'=>'Gris',
                'hex'=>'#A0A0A0',
                'prefix'=>'gri'
            ],[//8
                'name'=>'Negro',
                'hex'=>'#000000',
                'prefix'=>'neg'
            ],[//9
                'name'=>'Blanco',
                'hex'=>'#ffffff',
                'prefix'=>'bla'
            ],[//7
                'name'=>'Naranja',
                'hex'=>'#FF8000',
                'prefix'=>'nar'
            ],[//7
                'name'=>'Morado',
                'hex'=>'#6600CC',
                'prefix'=>'mor'
            ]
        ];
        foreach($items as $item){
            DwSetpoint\Models\Color::create($item);
        }
    }
}
