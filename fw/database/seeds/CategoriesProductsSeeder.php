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
        foreach(\DwSetpoint\Models\Product::getAll() as $product){
            $product->categories()->attach(\DwSetpoint\Models\Category::getRandom()->id);
        }
    }
}
