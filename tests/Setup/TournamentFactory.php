<?php

namespace Tests\Setup;

use App\Game;
use App\Team;
use App\Sport;
use App\Tournament;

class TournamentFactory
{
    protected $gamesCount = 0;

    public function withGames($count)
    {
        $this->gamesCount = $count;

        return $this;
    }

    public function create()
    {
        $sport = factory(Sport::class)->create();

        $tournament = factory(Tournament::class)->create([
            'sport_id' => $sport->id,
        ]);

        $games = [];
        for ($i = 0; $i < $this->gamesCount; $i++) {
            $homeTeam = factory(Team::class)->create([
                'sport_id' => $sport->id,
            ]);
            $awayTeam = factory(Team::class)->create([
                'sport_id' => $sport->id,
            ]);

            $games[] = factory(Game::class)->create([
                'tournament_id' => $tournament->id,
                'home_id' => $homeTeam->id,
                'away_id' => $awayTeam->id,
            ]);

            return $tournament;
        }
    }
}