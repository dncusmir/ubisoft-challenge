<?php

namespace Tests\Feature;

use App\Team;
use Tests\TestCase;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ManageTeamsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function a_user_can_add_teams()
    {
        $this->withoutExceptionHandling();

        $this->get('teams/create')->assertStatus(200);

        $attributes = factory(Team::class)->raw();

        $response = $this->followingRedirects()->post('teams', $attributes);

        $response->assertSee($attributes['name']);
    }

    /** @test */
    public function a_team_must_have_a_name()
    {
        $attributes = factory(Team::class)->raw(['name' => '']);

        $this->post('/teams', $attributes)->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_team_must_belong_to_a_sport()
    {
        $attributes = factory(Team::class)->raw();
        $attributes['sport_id'] = '';
        
        $this->post('teams')->assertSessionHasErrors('sport_id');
        
    }
}
