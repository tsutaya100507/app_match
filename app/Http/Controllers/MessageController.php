<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MessageController extends Controller
{
    // 投稿した案件一覧
    public function publicMessages()
    {
        return view('message/public');
    }

    // 投稿した案件一覧
    public function directMessages()
    {
        return view('message/direct');
    }
}
