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
        'subCategory' => $subCatengory->id,
        'code' => $code,
        'barcode' => $faker->isbn13,
        'title' => $title,
        'realPrice' => $realPrice,
        'cover' => $faker->randomElement([20,50,100,150,300,500,800,1000,15000]),
        'minOffer' => $faker->randomElement([10,50,100]),
        'maxOffer' => $faker->randomElement([150,200,250,300,500]),
        'bids' => $faker->randomElement([10,20,30,40,50,60,70,80,90,100]),
        'maxPrice' => $realPrice*0.90,
        'userQuota' => $faker->randomElement([10, 15, 20]),
        'usersLimit' => $faker->randomElement([50,100,200,500]),
        'deathTime' => $faker->randomElement([120, 340, 680]),
        'delay' => $faker->randomElement([10,15,20]),
        'maxUserQuiet' => $faker->randomElement([20,30,40]),
        'deathTime' => $faker->randomElement([10,20,30,40]),
        'description' => join("\n", $faker->paragraphs(rand(1, 3), false)),
        'startDate' => $startDate,
        'endDate' => $endDate,
        'published' => $faker->boolean(80),
        'status' => $faker->randomElement([0, 0, 0, 0, 0, 1, 1, 2, 2, 2, 3]),
        'winner' => null,
        'totalEnrollments' => rand(10, 100),
        'inflows' => rand(3000, 15000),
        'soldFor' => rand(3000, 7000)
         
   ];
});

