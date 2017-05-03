<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ProductsSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */
    
    public function run() {
       $faker = Faker::create();
        for($i=1; $i<20; $i++)
  		{ 
  			DB::table('products')->insert([
  				'id' => $i,
  				'name' => "moto ".$i,
  				'brand_id' => 1,
  				'description'=> $faker->text(200), 				
  				'created_at' => $faker->dateTime,
    		  	'updated_at' => $faker->dateTime,
    		  	'slug'=>'Moto-Agradable'.$i,
    		  	'code'=>'moto-'.$i,
    		  	'serial_number' =>$faker->numberBetween(1000,9000),
            'color'=>$faker->colorName,
    		  	'type_id'=> 1,
          	]);
  		}
       
        
    }

}
