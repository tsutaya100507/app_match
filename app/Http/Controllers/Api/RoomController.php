<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\User;


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

    public function getPartnerName(Request $request)
    {
        \Log::info($request);

        $room = Room::where('id', $request->room_id)->first();

        \Log::info($room);

        if ($room->send_user_id == $request->user_id)
        {
            $partnerUserId = $room->recieve_user_id;
        } else {
            $partnerUserId = $room->send_user_id;
        }

        \Log::info($partnerUserId);

        $user = User::where('id', $partnerUserId)->first();

        \Log::info($user);

        return $user->name;
    }
}
