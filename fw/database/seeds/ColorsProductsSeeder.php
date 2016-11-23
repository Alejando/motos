<?php

use Illuminate\Database\Seeder;

class ColorProductSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //factory(DwSetpoint\Models\Brand::class,10)->create();
        $items = [
            [//1
                'color_id'=>'8',
                'product_id'=>'1'
            ],[//2
                'color_id'=>'9',
                'product_id'=>'1'
            ],[//3
                'color_id'=>'8',
                'product_id'=>'2'
            ],[//4
                'color_id'=>'9',
                'product_id'=>'2'
            ],[//5
                'color_id'=>'10',
                'product_id'=>'3'
            ],[//6
                'color_id'=>'9',
                'product_id'=>'4'
            ],[//7
                'color_id'=>'11',
                'product_id'=>'4'
            ],[//8
                'color_id'=>'9',
                'product_id'=>'5'
            ],[//9
                'color_id'=>'4',
                'product_id'=>'5'
            ],[//10
                'color_id'=>'7',
                'product_id'=>'6'
            ],[//11
                'color_id'=>'4',
                'product_id'=>'6'
            ]
        ];
        foreach($items as $item){
            $product = DwSetpoint\Models\Product::getById($item['product_id']);
            $product->colors()->attach($item['color_id']);
        }
    }

}
