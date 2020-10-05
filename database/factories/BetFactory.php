<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Bet;
use Faker\Generator as Faker;

$factory->define(Bet::class, function (Faker $faker) {
  return [
    'bank' => $faker->randomFloat(),
    'user_id' => $faker->numberBetween(1, 19),
    'skins' => $faker->randomDigitNotNull,
    'is_win' => $faker->boolean,
    'game_id' => $faker->numberBetween(1, 19)
  ];
});
