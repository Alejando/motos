<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;


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
                'product_id'=>'1'
            ]
        ];

        $faker = Faker::create();
        for($i=2; $i<105; $i++)
        { 
            $array_item = [
                'category_id'=>rand(1,18),
                'product_id'=>$i,
            ];
            array_push($items, $array_item);
        }

        $categories = DwSetpoint\Models\Category::all()->toArray();
        foreach($items as $item){
            $product = DwSetpoint\Models\Product::getById($item['product_id']);
            $product->categories()->attach($item['category_id']);

            // $product->categories()->attach($item['category_id']);
            // $product->categories()->associate($categories[rand(1, count($categories) - 1)][$item['product_id']]);

            // $user = App\User::find(1);
            // $user->roles()->attach($roleId);
        }

    }
}
