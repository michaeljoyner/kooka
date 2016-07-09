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
        'email' => $faker->safeEmail,
        'password' => str_random(10),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Blog\Post::class, function (Faker\Generator $faker) {
    return [
        'title'        => $faker->sentence,
        'description'  => $faker->paragraph,
        'body'         => $faker->paragraphs(5, true),
        'published'    => 0,
        'published_at' => $faker->date()
    ];
});

$factory->define(App\Stock\Category::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->words(3, true),
        'description'  => $faker->paragraph,
    ];
});

$factory->define(App\Stock\Product::class, function (Faker\Generator $faker, $attributes) {
    $id = isset($attributes['category_id']) ? $attributes['category_id'] : factory(\App\Stock\Category::class)->create()->id;
    return [
        'category_id' => $id,
        'name'        => $faker->sentence,
        'description'  => $faker->paragraph,
        'price'         => $faker->numberBetween(1000, 20000),
        'available'    => 0,
    ];
});
