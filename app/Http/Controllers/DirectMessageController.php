<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DirectMessage;

class DirectMessageController extends Controller
{
    
    public function show(Request $request) {
        $dms = DirectMessage::where('room_id', $request->room_id);
        return response($dms, 201);
    }

}
