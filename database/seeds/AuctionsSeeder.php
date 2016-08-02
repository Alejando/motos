<?php

use Illuminate\Database\Seeder;

class AuctionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        
//        $faker= Faker\Factory::create();
//        $starDate = $faker->dateTimeBetween('-1 months', '+2 months');
//       echo $starDate->format("Y-m-d H:i:s");
//       $starDate->add(new DateInterval('P1DT1H'));
////       echo "\n".$starDate->format("Y-m-d H:i:s");
//       die();
//        echo sprintf("%0d", rand(1, 10));
//       die();
        factory(\GlimGlam\Models\Auction::class, 200)
            ->create();
           
    }

}
