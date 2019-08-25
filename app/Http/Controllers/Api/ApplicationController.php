<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Application;
use App\Models\Room;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\PostSent;

class ApplicationController extends Controller
{
    public function index(Request $request)
    {
        \Log::info($request);
        $applications = Application::join('projects', 'applications.project_id', '=', 'projects.id')
                                   ->join('users', 'projects.user_id', '=', 'users.id')
                                   ->where('applications.user_id', $request->user_id)
                                   ->select('applications.created_at',
                                            'projects.id',
                                            'projects.title', 
                                            'projects.description', 
                                            'projects.type', 
                                            'projects.lower_price',
                                            'projects.upper_price',
                                            'users.name')
                                   ->get();
        \Log::info($applications); 
        return $applications;    
    }
    
    public function check(Request $request)
    {
        \Log::info($request);
        $application = Application::where('user_id', $request->user_id)
                                  ->where('project_id', $request->project_id)
                                  ->get();
        \Log::info($application);
        // if (empty($application)){
        //     $result = false;
        //     return $result;
        // } else {
        //     $result = true;
        //     return response($result, 201);
        // }
        return $application;
    }

    public function store(Request $request)
    {
        \Log::info($request);

        $application = new Application();
        $application->user_id    = $request->user_id;
        $application->project_id = $request->project_id;
        $application->save();

        \Log::info($request->user_id);
        \Log::info($request->project_user_id);

        // 同じユーザーの組み合わせで作成されたDMルームを検索する。
        $room = Room::where('send_user_id', $request->user_id)->where('recieve_user_id', $request->project_user_id)->orWhere('send_user_id', $request->project_user_id)->where('recieve_user_id', $request->user_id)->first();

        \Log::info("room");
        \Log::info($room);

        if (empty($room))
        {
            \Log::info("aaaaaa");
            $room = new Room();
            $room->send_user_id    = $request->user_id;
            $room->recieve_user_id = $request->project_user_id;
            $room->save();
        }
       
        \Log::info($room);

        $room_url = env('APP_URL', 'http://localhost:3000') . '/dmroom/' . "$room->id";

        \Log::info($room_url);

        $project_user = User::find($request->project_user_id);
        Mail::to($project_user->email)->send(new PostSent($project_user,$room_url));

        return response($application, 201);

    }
}
