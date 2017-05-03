<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductTypesSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        $items = [
            [//1
             'name'=>"moto"
            ],
            [//1
             'name'=>"boutique"
            ]
        ];

        foreach($items as $item){
            $type =DwSetpoint\Models\ProductType::create($item);
        }
       
        
    }

}

