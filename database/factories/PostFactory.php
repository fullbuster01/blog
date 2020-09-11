<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Post::class, function (Faker $faker) {
    $title = $faker->sentence;
    $slug = Str::slug($title);
    return [
        'category_id' => rand(1, 2),
        'user_id' => rand(1, 3),
        'title' => $title,
        'slug' => $slug,
        'body' => $faker->paragraph(10)
    ];
});
