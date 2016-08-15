<?php
class HelperFakerAuction{
    public static $contador = 1;
}
$factory->define(GlimGlam\Models\Auction::class, function (Faker\Generator $faker) {
    $realPrice = $faker->numberBetween(500, 10000);
    $startDate = $faker->dateTimeBetween('-1 months', '+2 months');
    $endDate = clone $startDate;
    $endDate->add(new DateInterval($faker->randomElement(['P1DT1H','P0DT5H','P3DT10H','P2DT0H','P1DT12H'])));
    $categoryRandom = GlimGlam\Models\Category::getRandomParentCategory();
    $subCatengory = $faker->randomElement( $categoryRandom->subCategories()->get()->all() );
    $title = "Titulo Subasta " . HelperFakerAuction::$contador;
    $code = 'SUB'.sprintf("%03d",  HelperFakerAuction::$contador);
    HelperFakerAuction::$contador++;
    
    return [
        'target' => rand(0, 2),
        'category' => $categoryRandom->id,
        'sub_category' => $subCatengory->id,
        'code' => $code,
        'barcode' => $faker->isbn13,
        'title' => $title,
        'real_price' => $realPrice,
        'cover' => $faker->randomElement([20,50,100,150,300,500,800,1000,15000]),
        'min_offer' => $faker->randomElement([10,50,100]),
        'max_offer' => $faker->randomElement([150,200,250,300,500]),
        'bids' => $faker->randomElement([10,20,30,40,50,60,70,80,90,100]),
        'last_offer' =>  $faker->randomElement([10,20,30,40,50,60,70,80,90,100]),
        'max_price' => $realPrice*0.90,
        'user_quota' => $faker->randomElement([10, 15, 20]),
        'users_limit' => $faker->randomElement([50,100,200,500]),
        'death_time' => $faker->randomElement([120, 340, 680]),
        'delay' => $faker->randomElement([10,15,20]),
        'max_user_quiet' => $faker->randomElement([20,30,40]),
        'death_time' => $faker->randomElement([10,20,30,40]),
        'description' => join("\n", $faker->paragraphs(rand(1, 3), false)),
        'start_date' => $startDate,
        'end_date' => $endDate,
        'ready' => $faker->boolean(80),
        'status' => $faker->randomElement([0, 0, 0, 0, 0, 1, 1, 2, 2, 2, 3]),
        'winner' => null,
        'total_enrollments' => rand(10, 100),
        'inflows' => rand(3000, 15000),
        'sold_for' => rand(3000, 7000)
         
   ];
});

