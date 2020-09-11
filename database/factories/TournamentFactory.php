<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Sport;
use App\Tournament;
use Faker\Generator as Faker;

$factory->define(Tournament::class, function (Faker $faker) {
    return [
        'name' => $faker->word(),
        'sport_id' => factory(Sport::class),
    ];
});
