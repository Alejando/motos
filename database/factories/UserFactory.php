<?php
$factory->define(GlimGlam\Models\User::class, function (Faker\Generator $faker) {
    $gender = $faker->boolean();
    return [
        'name'=> $faker->name($gender ? 'male' : 'female'),
        'email'=> $faker->email,
        'password' => bcrypt('secret'),
        'profile' =>  \GlimGlam\Models\User::PROFILE_CLIENT,
        'birthday' => $faker->dateTimeBetween('-50 years', '-18 years'),
        'gender' => $gender
    ];
});

