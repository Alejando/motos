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
                'name'=>'Extra chica',
                'code'=>'EXCH'
            ],[//2
                'name'=>'Chica',
                'code'=>'CH'
            ],[//3
                'name'=>'Mediana',
                'code'=>'M'
            ],[//4
                'name'=>'Grande',
                'code'=>'G'
            ],[//5
                'name'=>'Extra grande',
                'code'=>'EXG'
            ],[//6
                'name'=>'20',
                'code'=>'C200'
            ],[//7
                'name'=>'20.5',
                'code'=>'C205'
            ],[//8
                'name'=>'21',
                'code'=>'C210'
            ],[//9
                'name'=>'21 1/2',
                'code'=>'C215'
            ],[//10
                'name'=>'22',
                'code'=>'C220'
            ],[//11
                'name'=>'22 1/2',
                'code'=>'C225'
            ],[//12
                'name'=>'23',
                'code'=>'C230'
            ],[//13
                'name'=>'23 1/2',
                'code'=>'C235'
            ],[//14
                'name'=>'24',
                'code'=>'C240'
            ],[//15
                'name'=>'24 1/2',
                'code'=>'C245'
            ],[//16
                'name'=>'25',
                'code'=>'C250'
            ],[//17
                'name'=>'25 1/2',
                'code'=>'C255'
            ],[//18
                'name'=>'26',
                'code'=>'C260'
            ],[//19
                'name'=>'26 1/2',
                'code'=>'C265'
            ],[//20
                'name'=>'27',
                'code'=>'C270'
            ],[//21
                'name'=>'27 1/2',
                'code'=>'C275'
            ],[//22
                'name'=>'28',
                'code'=>'C280'
            ],[//23
                'name'=>'28 1/2',
                'code'=>'C285'
            ],[//24
                'name'=>'29',
                'code'=>'C290'
            ],[//25
                'name'=>'29 1/2',
                'code'=>'C295'
            ],[//26
                'name'=>'30',
                'code'=>'C300'
            ],[//27
                'name'=>'30 1/2',
                'code'=>'C305'
            ]
        ];
        foreach($items as $item){
            DwSetpoint\Models\Color::create($item);
        }
    }

}
