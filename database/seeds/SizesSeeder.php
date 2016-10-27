<?php

use Illuminate\Database\Seeder;

class SizesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
//        $this->call(DwSetpoint\Models\Brand::class);
        //factory(DwSetpoint\Models\Size::class,10)->create();
        $items = [
            [//1
                'name'=>'UNI'
            ],[//2
                'name'=>'Extra chica'
            ],[//3
                'name'=>'Chica'
            ],[//4
                'name'=>'Mediana'
            ],[//5
                'name'=>'Grande'
            ],[//6
                'name'=>'Extra grande'
            ],[//7
                'name'=>'20'
            ],[//8
                'name'=>'20 1/2'
            ],[//9
                'name'=>'21'
            ],[//10
                'name'=>'21 1/2'
            ],[//11
                'name'=>'22'
            ],[//12
                'name'=>'22 1/2'
            ],[//13
                'name'=>'23'
            ],[//14
                'name'=>'23 1/2'
            ],[//15
                'name'=>'24'
            ],[//16
                'name'=>'24 1/2'
            ],[//17
                'name'=>'25'
            ],[//18
                'name'=>'25 1/2'
            ],[//19
                'name'=>'26',
            ],[//20
                'name'=>'26 1/2'
            ],[//21
                'name'=>'27'
            ],[//22
                'name'=>'27 1/2'
            ],[//23
                'name'=>'28'
            ],[//24
                'name'=>'28 1/2'
            ],[//25
                'name'=>'29'
            ],[//26
                'name'=>'29 1/2'
            ],[//27
                'name'=>'30'
            ],[//28
                'name'=>'30 1/2'
            ]
        ];
        foreach($items as $item){
            DwSetpoint\Models\Size::create($item);
        }
    }

}
