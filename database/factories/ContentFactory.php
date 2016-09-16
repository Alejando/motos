<?php

$factory->define(DwSetpoint\Models\Content::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name
    ];
});