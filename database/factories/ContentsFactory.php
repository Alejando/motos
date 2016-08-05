<?php
$factory->define(GlimGlam\Models\Enrollment::class, function(Faker\Generator $faker){
    return [
        'title' => $faker->title,
        'slug' => $faker->slug,
        'name' => $faker->title,
        'content' => $faker->paragraphs(rand(1, 4), true)
    ];
}); 