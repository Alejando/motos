<?php

$factory->define(DwSetpoint\Models\Size::class, function (Faker\Generator $faker) {
    return [
        'size' => $faker->name
    ];
});
