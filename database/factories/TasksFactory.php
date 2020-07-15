<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Task;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Tasks Factory
|--------------------------------------------------------------------------
*/

$factory->define(Task::class, function (Faker $faker) {
  return [
    'id' => $faker->unique()->uuid,
    'name' => $faker->word,
    'description' => $faker->sentence($nbWords = 6, $variableNbWords = true),
    'status' => $faker->randomElement(array('pending', 'in-progress', 'done')),
  ];
});
