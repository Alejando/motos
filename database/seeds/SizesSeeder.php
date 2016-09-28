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
                'name'=>'Extra chica'
            ],[//2
                'name'=>'Chica'
            ],[//3
                'name'=>'Mediana'
            ],[//4
                'name'=>'Grande'
            ],[//5
                'name'=>'Extra grande'
            ],[//6
                'name'=>'20'
            ],[//7
                'name'=>'20 1/2'
            ],[//8
                'name'=>'21'
            ],[//9
                'name'=>'21 1/2'
            ],[//10
                'name'=>'22'
            ],[//11
                'name'=>'22 1/2'
            ],[//12
                'name'=>'23'
            ],[//13
                'name'=>'23 1/2'
            ],[//14
                'name'=>'24'
            ],[//15
                'name'=>'24 1/2'
            ],[//16
                'name'=>'25'
            ],[//17
                'name'=>'25 1/2'
            ],[//18
                'name'=>'26',
            ],[//19
                'name'=>'26 1/2'
            ],[//20
                'name'=>'27'
            ],[//21
                'name'=>'27 1/2'
            ],[//22
                'name'=>'28'
            ],[//23
                'name'=>'28 1/2'
            ],[//24
                'name'=>'29'
            ],[//25
                'name'=>'29 1/2'
            ],[//26
                'name'=>'30'
            ],[//27
                'name'=>'30 1/2'
            ]
        ];
        foreach($items as $item){
            DwSetpoint\Models\Size::create($item);
        }
    }

}
