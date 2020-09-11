<?php

namespace App;

use App\Game;
use App\Sport;
use Illuminate\Database\Eloquent\Model;

class Tournament extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sport_id', 'over'
    ];

    public function path()
    {
        return "/tournaments/{$this->id}";
    }

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }

    public function games()
    {
        return $this->hasMany(Game::class);
    }
}
