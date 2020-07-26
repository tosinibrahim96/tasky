<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| User Factory
|--------------------------------------------------------------------------
*/

$factory->define(User::class, function (Faker $faker) {
  return [
    'username' => $faker->userName,
    'email' => $faker->unique()->safeEmail,
    'email_verified_at' => Arr::random([now(), null]),
    'password' => Hash::make('secret'),
    'remember_token' => Arr::random([Str::random(10), null])
  ];
});
