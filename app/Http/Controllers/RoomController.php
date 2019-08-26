<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;

class RoomController extends Controller
{
    // DMの相手一覧を取得
    public function index()
    {
        $user = Auth::user();
        $rooms = Room::where('send_user_id', $user->id)->orWhere('recieve_user_id', $user->id)->get();
        

        $data = [];
        $i = 0;
        foreach ($rooms as $room) {
            $data[$i]['id'] = $room->id;
            $data[$i]['userName'] = $room->otherUser->name;
            $i++;
        }
        return view('room/index', ['user' => $user, 'rooms' => $rooms, 'edited_rooms' => $data]);
    }
    
    // DM詳細ページ
    public function show($id)
    {
        $room = Room::where('id',$id)->first();
        $user = Auth::user();
     
        return view('room/show', ['room' => $room, 'user' => $user]);
    }

}
