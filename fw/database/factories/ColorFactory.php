<?php

$factory->define(DwSetpoint\Models\Color::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});