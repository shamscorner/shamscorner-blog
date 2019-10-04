<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {
    $title = $faker->word;
    $slug = Str::slug($title);
    return [
        'name' => $title,
        'slug' => $slug
    ];
});
