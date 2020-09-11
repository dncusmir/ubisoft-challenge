<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Game;
use App\Model;
use App\Team;
use App\Tournament;
use Faker\Generator as Faker;

$factory->define(Game::class, function (Faker $faker) {
    return [
        'tournament_id' => factory(Tournament::class),
        'home_id' => factory(Team::class),
        'away_id' => factory(Team::class),
    ];
});
