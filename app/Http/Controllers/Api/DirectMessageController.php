<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\DirectMessage;



class DirectMessageController extends Controller
{

    public function show(Request $request) {
        \Log::info($request);

        $dms = DirectMessage::where('room_id', $request->room_id)
                        ->join('users', 'direct_messages.user_id', '=', 'users.id')
                        ->select('direct_messages.body', 'direct_messages.id', 'direct_messages.created_at', 'users.id as user_id', 'users.name', 'users.image_path')
                        ->get();
        \Log::info($dms);
        return response($dms, 201);
    }

    public function store(Request $request)
    {
        \Log::info($request);
        $dm = new DirectMessage();
        $dm->body = $request->body;
        $dm->user_id = $request->user_id;
        $dm->room_id = $request->room_id;
        $dm->save();

        $dms = DirectMessage::where('room_id', $dm->room_id)
                        ->join('users', 'direct_messages.user_id', '=', 'users.id')
                        ->select('direct_messages.body', 'direct_messages.id', 'direct_messages.created_at', 'users.id as user_id', 'users.name', 'users.image_path')
                        ->get();

        return response($dms, 201);
    }
}
