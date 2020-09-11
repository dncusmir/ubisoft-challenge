<?php

namespace Tests\Unit;

use App\Team;
use App\Sport;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TeamTest extends TestCase
{
    use WithFaker, RefreshDatabase;

    /** @test */
    public function it_belongs_to_a_sport()
    {
        $team = factory(Team::class)->create();

        $this->assertInstanceOf(Sport::class, $team->sport);
    }
}
