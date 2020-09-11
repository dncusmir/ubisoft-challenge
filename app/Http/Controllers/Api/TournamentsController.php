<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Resources\Tournament as TournamentResource;
use App\Http\Resources\GameCollection;
use App\Tournament;

class TournamentsController extends Controller
{
    public function show($id)
    {
        return new TournamentResource(Tournament::find($id));
    }

    public function games($id)
    {
        return new GameCollection(Tournament::find($id)->games);
    }
}
