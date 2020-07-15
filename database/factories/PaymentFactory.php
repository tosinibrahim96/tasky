<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Payment;
use Faker\Generator as Faker;


/*
|--------------------------------------------------------------------------
| Payments Factory
|--------------------------------------------------------------------------
*/



$factory->define(Payment::class, function (Faker $faker) {
  $faker->addProvider(new \Faker\Provider\en_NG\Person($faker));

  return [
    'id' => $faker->unique()->uuid,
    'updated_by' => $faker->name,
    'amount_received' => $faker->numberBetween($min = 1000, $max = 9000),
  ];
});
