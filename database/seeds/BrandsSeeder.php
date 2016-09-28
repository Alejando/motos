<?php

use Illuminate\Database\Seeder;

class BrandsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //factory(DwSetpoint\Models\Brand::class,10)->create();
        $items = [
            [//1
                'name'=>'Nike'
            ],[//2
                'name'=>'Adidas'
            ],[//3
                'name'=>'Wilson'
            ],[//4
                'name'=>'Babolat'
            ],[//5
                'name'=>'Prince'
            ],[//6
                'name'=>'Yonex'
            ]
        ];
        foreach($items as $item){
            DwSetpoint\Models\Brand::create($item);
        }
    }

}
