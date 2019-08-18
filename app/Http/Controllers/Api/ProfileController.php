<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        \Log::info($request);
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->intro = $request->intro;
        $user->save();
        return response($user, 201);
    }
}
