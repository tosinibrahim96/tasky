<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Projects Factory
|--------------------------------------------------------------------------
*/

$factory->define(Project::class, function (Faker $faker) {
  return [
    'id' => $faker->unique()->uuid,
    'name' => $faker->word,
    'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    'amount_expected' => $faker->numberBetween($min = 10000, $max = 90000),
  ];
});
