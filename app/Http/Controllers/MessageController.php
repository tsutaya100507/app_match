<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    // 投稿した案件一覧
    public function publicMessages()
    {
        $user = Auth::user();
        return view('message/public', ['user' => $user]);
    }

    // DM案件一覧
    public function directMessages()
    {
        return view('message/direct');
    }
}
