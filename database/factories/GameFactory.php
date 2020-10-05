<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Game;
use Faker\Generator as Faker;

$factory->define(Game::class, function (Faker $faker) {
  return [
    'multiplier' => $faker->randomFloat(2, 1, 50),
    'skins' => $faker->randomDigitNotNull,
    'status' => 2,
    'profit' => $faker->randomFloat(2, 1, 1500),
    'players' => $faker->randomDigitNotNull,
    'bank' => $faker->randomFloat(2, 1, 1500)
  ];
});
