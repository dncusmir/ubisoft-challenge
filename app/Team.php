<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'sport_id',
    ];

    public function sport()
    {
        return $this->belongsTo(Sport::class);
    }
}