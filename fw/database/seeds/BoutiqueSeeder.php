<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class BoutiqueSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {
       $faker = Faker::create();
        for($i=100; $i<150; $i++)
  		{
  			DB::table('products')->insert([
  				'id' => $i,
  				'name' => "boutique ".$i,
  				'brand_id' => 1,
  				'description'=> $faker->text(200),
  				'created_at' => $faker->dateTime,
    		  	'updated_at' => $faker->dateTime,
    		  	'slug'=>'Boutique'.$i,
    		  	'code'=>'boutique-'.$i,
    		  	'serial_number' =>$faker->numberBetween(1000,9000),
            'color'=>$faker->colorName,
    		  	'type_id'=> 2,
            'category_id'=> rand(10,11),
            'favorite'=> 0,
          	]);
  		}


    }

}
