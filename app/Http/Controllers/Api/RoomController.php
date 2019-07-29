<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Room;

class RoomController extends Controller
{

    public function index(Request $request)
    {
        \Log::info($request->user_id);
        $rooms = Room::where('send_user_id', $request->user_id)->orWhere('recieve_user_id', $request->user_id)->get();

        $data = [];
        $i = 0;
        foreach ($rooms as $room) {
            $data[$i]['id'] = $room->id;
            \Log::info($request->user_id);
            $data[$i]['userName'] = $room->otherUser->name;
            \Log::info($data[$i]['userName']);

        }

        return $data;
    }

    public function store(Request $request)
    {
        \Log::info($request->send_user_id);
        $room = new Room();
        \Log::info($room);
        $room->recieve_user_id = $request->recieve_user_id;
        $room->send_user_id = $request->send_user_id;
        $room->save();

        return response($room, 201);
    }
}
