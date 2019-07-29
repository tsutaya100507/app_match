<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // マイページ
    public function index()
    {
        return view('profile/index');
    }
}
