<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class ProfileController extends Controller
{
    // マイページ
    public function index()
    {
        $user = Auth::user();
        return view('profile/index', ['user' => $user]);
    }

    // 編集ページ
    public function edit()
    {
        $user = Auth::user();
        return view('profile/edit', ['user' => $user]);
    }
}
