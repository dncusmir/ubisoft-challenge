<?php

namespace App\Http\Controllers;

use App\Sport;
use Illuminate\Http\Request;

class SportsController extends Controller
{
    public function index()
    {
        $sports = Sport::all();

        // return view('sports.index', compact($sports));
        return view('sports.index')->with('sports', $sports);
    }

    public function create()
    {
        return view('sports.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $sport = Sport::create([
            'name' => $request->name,
        ]);

        // flash a message
        session()->flash('success', 'Sport created successfully!');
        // redirect user
        return redirect(route('sports.index'));
    }
}
