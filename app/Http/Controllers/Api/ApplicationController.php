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
    // 申し込んだ案件一覧の取得
    public function index(Request $request)
    {
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
        return $applications;    
    }
    
    // 申し込みがされているかチェック
    public function check(Request $request)
    {
        $application = Application::where('user_id', $request->user_id)
                                  ->where('project_id', $request->project_id)
                                  ->get();
        return $application;
    }

    // 案件への申し込み
    public function store(Request $request)
    {

        $application = new Application();
        $application->user_id    = $request->user_id;
        $application->project_id = $request->project_id;
        $application->save();

        // 申し込みをした際、DMをやりとりするスペースがなければ作成する
        // 同じユーザーの組み合わせで作成されたDMルームを検索する。
        $room = Room::where('send_user_id', $request->user_id)->where('recieve_user_id', $request->project_user_id)->orWhere('send_user_id', $request->project_user_id)->where('recieve_user_id', $request->user_id)->first();

        if (empty($room))
        {
            $room = new Room();
            $room->send_user_id    = $request->user_id;
            $room->recieve_user_id = $request->project_user_id;
            $room->save();
        }
       
        $room_url = env('APP_URL', 'http://localhost:3000') . '/dmroom/' . "$room->id";

        $project_user = User::find($request->project_user_id);
        
        // 案件の投稿者にメールを送信する
        Mail::to($project_user->email)->send(new PostSent($project_user,$room_url));

        return response($application, 201);

    }
}
