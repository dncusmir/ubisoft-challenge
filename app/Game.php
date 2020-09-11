<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $fillable = ['tournament_id', 'home_id', 'away_id'];
    
    public function homeTeam()
    {
        return $this->hasOne(Team::class, 'id', 'home_id');
    }
    public function awayTeam()
    {
        return $this->hasOne(Team::class, 'id', 'away_id');
    }
}
