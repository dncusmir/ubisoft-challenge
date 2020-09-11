<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\User;
use App\Http\Resources\User as UserResource;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show($id)
    {
        return new UserResource(User::find($id));
    }
    
    public function edit($id, Request $request)
    {
        $user = User::find($id);

        $data = $request->validate([
            'points' => 'required'
        ]);

        $user->update($data);

        return new UserResource($user);
    }
}
