<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sport extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
    ];

    public function path()
    {
        return "/sports/{$this->id}";
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }

    public function addTeam($name)
    {
        return $this->teams()->create(compact('name'));
    }
}
