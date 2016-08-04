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
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'password'       => str_random(10),
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
        'description' => $faker->paragraph,
    ];
});

$factory->define(App\Stock\Product::class, function (Faker\Generator $faker, $attributes) {
    $id = isset($attributes['category_id']) ? $attributes['category_id'] : factory(\App\Stock\Category::class)->create()->id;

    return [
        'category_id' => $id,
        'name'        => $faker->sentence,
        'description' => $faker->paragraph,
        'price'       => $faker->numberBetween(1000, 20000),
        'available'   => 0,
    ];
});

$factory->define(App\Orders\Order::class, function (Faker\Generator $faker) {
    return [
        'customer_name'    => $faker->name,
        'customer_phone'   => $faker->phoneNumber,
        'customer_email'   => $faker->email,
        'customer_address' => $faker->address,
        'enquiry'          => $faker->paragraph,
        'original_quote'   => $faker->numberBetween(1000, 100000)
    ];
});

$factory->define(App\Orders\OrderItem::class, function (Faker\Generator $faker, $attributes) {
    $id = isset($attributes['order_id']) ? $attributes['order_id'] : factory(\App\Orders\Order::class)->create()->id;
    $product_id = isset($attributes['product_id']) ? $attributes['product_id'] : factory(\App\Stock\Product::class)->create()->id;

    return [
        'order_id'   => $id,
        'product_id' => $product_id,
        'name'       => $faker->words(3, true),
        'price'      => $faker->numberBetween(1000, 100000),
        'quantity'   => $faker->numberBetween(1, 5),
        'quote'      => $faker->numberBetween(1000, 100000),
    ];
});
