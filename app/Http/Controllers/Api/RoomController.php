<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Room;
use App\User;


class RoomController extends Controller
{
    // DMのやりとりをするスペースを作成
    public function store(Request $request)
    {
        $room = new Room();
        $room->recieve_user_id = $request->recieve_user_id;
        $room->send_user_id = $request->send_user_id;
        $room->save();

        return response($room, 201);
    }

    // DMのやり取りをする相手ての名前を取得
    public function getPartnerName(Request $request)
    {

        $room = Room::where('id', $request->room_id)->first();


        if ($room->send_user_id == $request->user_id)
        {
            $partnerUserId = $room->recieve_user_id;
        } else {
            $partnerUserId = $room->send_user_id;
        }

        $user = User::where('id', $partnerUserId)->first();

        return $user->name;
    }
}
