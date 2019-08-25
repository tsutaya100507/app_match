<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Storage;


class ProfileController extends Controller
{
    public function update(Request $request)
    {
        // \Log::info($request);

        // $file_name = $request->file->getClientOriginalName();
        // $request->file->storeAs('public/',$file_name);

        // $image = file_get_contents($request->file->getRealPath());

        // \Log::info($image);
        $path = $request->file->store('profiles', 's3');
        // $image = $request->file();

        

        // $path = Storage::disk('s3')->putFile('/', $image, 'public');

        \Log::info($path);

        // \Log::info("/storage/".$file_name);
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->intro = $request->intro;
        $user->image_path = Storage::disk('s3')->url($path);
        $user->save();
        return response($user, 201);
    }
}
