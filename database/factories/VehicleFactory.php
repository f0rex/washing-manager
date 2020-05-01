<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Vehicle;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Vehicle::class, function (Faker $faker) {
    static $number = 1;
    return [
        'plate' => $number++,
        'last_washed_internally_at' => NULL,
        'last_washed_externally_at' => NULL,
        'created_at' => now(),
        'updated_at' => now(),
    ];
});
