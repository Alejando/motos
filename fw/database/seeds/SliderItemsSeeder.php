<?php

use Illuminate\Database\Seeder;

class SliderItemsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //factory(DwSetpoint\Models\Brand::class,10)->create();
        $items = [
            [//1
             'title'=>"Moto Super rápida" ,
             'n_order'=>"1" ,
              'description'=>"Esta es una moto nueva que sirve de ejemplo",
                'link'=>"hola",
                'sliders_id'=>'1'
            ],
            [//1
             'title'=>"Moto Super rápida 2" ,
             'n_order'=>"2" ,
              'description'=>"Esta es una moto nueva que sirve de ejemplo",
                'link'=>"hola",
                'sliders_id'=>'1'
            ],
            [//1
             'title'=>"Moto Super rápida 3 " ,
             'n_order'=>"3" ,
              'description'=>"Esta es una moto nueva que sirve de ejemplo",
                'link'=>"hola",
                'sliders_id'=>'1'
            ],
            [//1
             'title'=>"Moto Super rápida 4" ,
             'n_order'=>"4" ,
              'description'=>"Esta es una moto nueva que sirve de ejemplo",
                'link'=>"hola",
                'sliders_id'=>'1'
            ]

            

        ];
        foreach($items as $item){
            DwSetpoint\Models\SliderItem::create($item);
        }
    }

}

