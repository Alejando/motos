<?php

$factory->define(GlimGlam\Models\Address::class, function (Faker\Generator $faker) {
    return [
        'country' => $faker->country,
        'city' => $faker->city,
        'state' => $faker->state,
        'street' => $faker->streetName,
        'streetNumber'  => $faker->buildingNumber,
        'suiteNumber'  => $faker->buildingNumber,
        'neighborhood' => $faker->citySuffix,
        'postalcode'  => $faker->postcode,
        'user'  => null,
    ];
});
