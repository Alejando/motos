<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductFeatureSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run() {
       $faker = Faker::create();
        for($i=1; $i<200; $i++)
  		{ 
  			DB::table('product_features')->insert([
  				'id'=>$i,
          'name'=>$faker->text(rand(10,20)),
          'value'=>$faker->text(rand(40,60)),
          'n_order'=>rand(1,6),
          'product_id'=>rand(1,19),
          'type_product_feature_id'=>rand(1,5),
          ]);
  		}
       
        
    }

}
