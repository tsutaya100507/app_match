<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;

class RoomController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $rooms = Room::where('send_user_id', $user->id)->orWhere('recieve_user_id', $user->id)->get();
        \Log::info(gettype($rooms));
        

        $data = [];
        $i = 0;
        foreach ($rooms as $room) {
            $data[$i]['id'] = $room->id;
            $data[$i]['userName'] = $room->otherUser->name;
            \Log::info($data[$i]['userName']);
            $i++;
        }
        return view('room/index', ['user' => $user, 'rooms' => $rooms, 'edited_rooms' => $data]);
    }
    
    public function show($id)
    {
        \Log::info($id);
        $room = Room::where('id',$id)->first();
        $user = Auth::user();
        \Log::info("dmroom show");
        \Log::info($room);
        return view('room/show', ['room' => $room, 'user' => $user]);
    }

}
