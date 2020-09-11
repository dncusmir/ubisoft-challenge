<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Sport;

class ManageSportsTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function a_sport_must_have_a_name()
    {
        $attributes = factory(Sport::class)->raw(['name' => '']);

        $this->post('/sports', $attributes)->assertSessionHasErrors('name');
    }

    /** @test */
    public function a_user_can_add_sports()
    {
        $this->withoutExceptionHandling();

        $this->get('sports/create')->assertStatus(200);

        $attributes = factory(Sport::class)->raw();

        $response = $this->followingRedirects()->post('sports', $attributes);
        
        $response->assertSee($attributes['name']);
    }

}
