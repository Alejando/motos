<?php

use Illuminate\Database\Seeder;

class CategoriesProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        //factory(DwSetpoint\Models\Brand::class,10)->create();
        $items = [
            [//1
                'category_id'=>'17',
                'product_id'=>'11'
            ]
        ];

        $categories = DwSetpoint\Models\Category::all()->toArray();
        foreach($items as $item){
            $product = DwSetpoint\Models\Product::getById($item['product_id']);
            //$product->categories()->attach($item['category_id']);
            $product->categories()->associate($categories[rand(1, count($categories) - 1)][$item['product_id']]);
        }

    }
}
