<?php

$factory->define(DwSetpoint\Models\Brand::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});
