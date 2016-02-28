<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->paragraph,
        'published_at' => $faker->dateTime(),
        'user_id' => $faker->biasedNumberBetween($min = 1, $max = 8, $function = 'sqrt'),
        'page_rank' => $faker->biasedNumberBetween($min = 0, $max = 0, $function = 'sqrt')
    ];
});

$factory->define(App\Comment::class, function (Faker\Generator $faker) {
    return [
        'body' => $faker->paragraph,
        'published_at' => $faker->dateTime(),
        'user_id' => $faker->biasedNumberBetween($min = 1, $max = 8, $function = 'sqrt'),
        'parent_id' => $faker->biasedNumberBetween($min = 0, $max = 0, $function = 'sqrt'),
        'post_id' => $faker->biasedNumberBetween($min = 1, $max = 12, $function = 'sqrt')
    ];
});
