<?php

namespace Tests\Unit;

use App\Game;
use App\Sport;
use App\Tournament;
use Tests\TestCase;
use Facades\Tests\Setup\TournamentFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TournamentTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_sport()
    {
        $tournament = factory(Tournament::class)->create();

        $this->assertInstanceOf(Sport::class, $tournament->sport);
    }

    /** @test */
    public function its_games_are_from_its_sport()
    {
        $tournament = TournamentFactory::withGames(1)->create();
        
        $sportClass = get_class($tournament->sport);

        $games = $tournament->games;
        $this->assertEquals(1, $games->count());

        foreach ($games as $game) {
            $this->assertInstanceOf(Game::class, $game);
            $this->assertInstanceOf($sportClass, $game->homeTeam->sport);
            $this->assertInstanceOf($sportClass, $game->awayTeam->sport);
        }
    }

    /** @test */
    public function a_tournament_has_a_path()
    {
        $tournament = factory(Tournament::class)->create();

        $this->assertEquals('/tournaments/' . $tournament->id, $tournament->path());
    }
}
