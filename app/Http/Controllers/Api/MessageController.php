<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Message;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostSent;

class MessageController extends Controller
{
    public function show($project_id)
    {
        \Log::info($project_id);

        $messages = Message::where('project_id', $project_id)
                        ->join('users', 'messages.user_id', '=', 'users.id')
                        ->select('messages.body', 'users.name')
                        ->get();
        \Log::info($messages);
        return $messages;   
    }

    public function store(Request $request)
    {
        $message = new Message();
        $message->body = $request->body;
        $message->user_id = $request->user_id;
        $message->project_id = $request->project_id;
        $message->save();

        $messages = Message::where('project_id', $message->project_id)
                        ->join('users', 'messages.user_id', '=', 'users.id')
                        ->select('messages.body', 'users.name')
                        ->get();
        \Log::info($messages);
        
        $user = User::find($request->user_id);
        Mail::to('tyu100507@gmail.com')->send(new PostSent($user));
        return $messages;
    }
}
