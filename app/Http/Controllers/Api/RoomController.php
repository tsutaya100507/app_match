<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Room;

class RoomController extends Controller
{
    public function store(Request $request)
    {
        $room = new Room();
        $room->recieve_user_id = $request->recieve_user_id;
        $room->send_user_id = $request->send_user_id;
        $room->save();

        return response($room, 201);
    }
}
