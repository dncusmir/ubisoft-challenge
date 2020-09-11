<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class Game extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'tournament_id' => $this->tournament_id,
            'home_id' => $this->home_id,
            'away_id' => $this->away_id,
            'winner' => $this->winner,
            'home' => $this->homeTeam->name,
            'away' => $this->awayTeam->name,
        ];
    }
}
