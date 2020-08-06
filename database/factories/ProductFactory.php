<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Product;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'description' => Str::random(144),
        'price' => $faker->randomFloat(2, 1, 100),
        'image' => Str::random(30),
    ];
});
