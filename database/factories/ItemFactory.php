<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Item::class, function (Faker $faker) {
  return [
    'name' => $faker->word,
    'market_hash_name' => $faker->uuid,
    'image' => $faker->imageUrl($height = 80),
    'price' => $faker->randomFloat(2, 1, 1000)
  ];
});
