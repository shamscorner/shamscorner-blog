<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Category;
use Faker\Generator as Faker;

$factory->define(Category::class, function (Faker $faker) {
    $title = $faker->sentence(2, true);
    $slug = Str::slug($title);
    return [
        'name' => $title,
        'slug' => $slug
    ];
});
