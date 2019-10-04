<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Comment;
use Faker\Generator as Faker;

$factory->define(Comment::class, function (Faker $faker) {
    return [
        'post_id' => $faker->numberBetween(1, 200),
        'user_id' => $faker->numberBetween(1, 3),
        'comment' => $faker->sentence(12, true)
    ];
});
