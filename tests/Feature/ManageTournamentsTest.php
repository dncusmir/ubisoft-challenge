<?php

namespace Tests\Feature;

use App\Tournament;
use Tests\TestCase;
use Facades\Tests\Setup\TournamentFactory;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageTournamentsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_add_tournaments()
    {
        $this->withoutExceptionHandling();

        $this->get('tournaments/create')->assertStatus(200);

        $tournament = TournamentFactory::withGames(1)->create();

        $attributes = $tournament->toArray();

        $response = $this->followingRedirects()->post('tournaments', $attributes);

        $response->assertSee($tournament['name']);
    }

    /** @test */
    public function a_tournament_must_have_a_name()
    {
        $attributes = factory(Tournament::class)->raw(['name' => '']);

        $this->post('/tournaments', $attributes)->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_tournament_must_have_a_sport()
    {
        $attributes = factory(Tournament::class)->raw(['sport_id' => '']);

        $this->post('/tournaments', $attributes)->assertSessionHasErrors('sport_id');
    }

    /** @test */
    public function a_tournament_must_have_games()
    {
        $attributes = factory(Tournament::class)->raw();

        $this->post('/tournaments', $attributes)->assertSessionHasErrors('sport_id');

        $tournament = TournamentFactory::withGames(1)->create();

        $attributes = $tournament->toArray();

        $response = $this->followingRedirects()->post('tournaments', $attributes);

        $response->assertSee($tournament['name']);

        $this->assertEquals(1, count($tournament->games));
    }
}
