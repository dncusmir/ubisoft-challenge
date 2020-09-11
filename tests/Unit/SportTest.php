<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Sport;

class SportTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function it_has_a_path()
    {
        $sport = factory(Sport::class)->create();

        $this->assertEquals('/sports/' . $sport->id, $sport->path());
    }

    /**
     * @test
     */
    public function it_can_add_a_team()
    {
        $sport = factory(Sport::class)->create();

        $team = $sport->addTeam('Test Team');

        $this->assertCount(1, $sport->teams);
        $this->assertTrue($sport->teams->contains($team));
    }

}
