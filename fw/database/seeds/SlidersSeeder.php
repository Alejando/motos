<?php

use Illuminate\Database\Seeder;

class SlidersSeeder extends Seeder 
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
       
        $items = [
            [//1
             'name'=>"home"  
            ]
        ];
        foreach($items as $item){
            DwSetpoint\Models\Slider::create($item);
        }
    }

}