<?php

$factory->define(GlimGlam\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->sentence(2,true),
        'parentCategory' => null
    ];
});
