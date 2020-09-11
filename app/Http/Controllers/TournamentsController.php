<?php

namespace App\Http\Controllers;

use App\Game;
use App\Team;
use App\Sport;
use App\Tournament;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TournamentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tournaments = Tournament::all();

        return view('tournaments.index', compact('tournaments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $sports = Sport::all();

        return view('tournaments.create', compact('sports'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'name' => 'required',
        //     'sport_id' => 'required',
        // ]);
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'sport_id' => [
                'required',
                function ($attribute, $value, $fail) {
                    $teamsCount = Team::where($attribute, '=', $value)->count();
                    
                    if ($teamsCount <= 1) {
                        $fail('The sport must have at least 2 teams.');
                    }
                },
            ],
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }

        $tournament = Tournament::create([
            'name' => $request->name,
            'sport_id' => $request->sport_id,
        ]);

        $teams = Sport::find($request->sport_id)->teams;
        $shuffledTeams = $teams->shuffle();

        foreach ($shuffledTeams as $key => $team) {
            if ($key % 2 == 0) {
                $home = $team;
            } else {
                $away = $team;
                Game::create([
                    'tournament_id' => $tournament->id,
                    'home_id' => $home->id,
                    'away_id' => $away->id,
                ]);
            }
        }

        session()->flash('success', 'Tournament added.');

        return redirect(route('tournaments.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tournament $tournament
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // return view('tournaments.show')->with('tournament', $tournament);

        $user = auth()->user()->id ?? -1;
        return view('tournaments.show')
            ->with('tournamentId', $id)
            ->with('userId', $user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
