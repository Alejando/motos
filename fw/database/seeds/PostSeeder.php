<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PostSeeder extends Seeder {

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run() {
       $faker = Faker::create();
        for($i=1; $i<50; $i++)
  		{
  			DB::table('posts')->insert([
  				'id'=>$i,
          'title'=>$faker->text(rand(20,30)),
          'body'=>$faker->text(300),
          'favorite'=>rand(0,1),
          'slug'=> $faker->text(rand(20,30)),
          'post_category_id'=>rand(1,5),
          'created_at'=>$faker->dateTime(),
          ]);
  		}


    }

}
