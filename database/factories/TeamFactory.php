<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Team;
use App\Sport;
use Faker\Generator as Faker;

$factory->define(Team::class, function (Faker $faker) {
    return [
        'name' => $faker->word,
        'sport_id' => factory(Sport::class),
    ];
});
