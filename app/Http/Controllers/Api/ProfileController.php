<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;

class ProfileController extends Controller
{
    public function update(Request $request)
    {
        \Log::info($request->file);

        // $file_name = $request->file->getClientOriginalName();
        // $request->file->storeAs('public/',$file_name);

        $image = base64_encode(file_get_contents($request->file->getRealPath()));


        // \Log::info("/storage/".$file_name);
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->intro = $request->intro;
        $user->image_path = $image;
        $user->save();
        return response($user, 201);
    }
}
