<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence;
    $slug = Str::slug($title);

    return [

        'user_id' => $faker->numberBetween(1, 3),
        'title' => $title,
        'slug' => $slug,
        'body' => $faker->paragraph(15, true),
        'view_count' => $faker->randomDigitNotNull,
        'status' => $faker->boolean,
        'is_approved' => $faker->boolean,

    ];
});
