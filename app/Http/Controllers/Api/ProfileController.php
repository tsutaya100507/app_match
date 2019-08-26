<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Storage;


class ProfileController extends Controller
{
    // プロフィールの更新
    public function update(Request $request)
    {

        $path = $request->file->store('profiles', 's3');

        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->intro = $request->intro;
        $user->image_path = Storage::disk('s3')->url($path);
        $user->save();
        return response($user, 201);
    }
}
