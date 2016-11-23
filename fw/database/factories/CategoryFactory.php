<?php
$factory->define(DwSetpoint\Models\Category::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});
