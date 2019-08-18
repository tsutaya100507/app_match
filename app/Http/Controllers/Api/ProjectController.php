<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Message;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    public function index()
    {
        // プロジェクトと一緒にユーザーの情報を返すapi
        $projects = Project::join('users', 'projects.user_id', '=', 'users.id')
                           ->select('users.name','projects.title','projects.id','projects.type','projects.description')
                           ->get();
        return $projects;
    }

    public function getLoginUserProject(Request $request) {
        $projects = Project::join('users', 'projects.user_id', '=', 'users.id')
                           ->where('user_id', $request->user_id)
                           ->get();
        \Log::info($projects);

        return response($projects, 201);
    }

    public function getMessagedProjects(Request $request)
    {
        \Log::info($request);
        $projects = Project::join('messages', 'messages.project_id', '=', 'projects.id')
                           ->join('users', 'projects.user_id', 'users.id')
                           ->where('messages.user_id', $request->user_id)
                           ->select('projects.id',
                                    'projects.title', 
                                    'projects.description', 
                                    'projects.type', 
                                    'projects.lower_price',
                                    'projects.upper_price',
                                    'users.name')
                           ->get()
                           ->unique();
        \Log::info($projects);
        
        // 取得した案件レコードに紐づく最初のパブリックメッセージを追加して新たな配列を作成。
        $new_projects = array();
        foreach($projects as $project)
        {
            $message = Message::join('users', 'messages.user_id', '=', 'users.id')
                              ->where('project_id', $project->id)
                              ->select('messages.body', 'users.name')
                              ->first();
            \Log::info($message);
            $project['message'] = $message->body;
            $project['user_name'] = $message->name;
            \Log::info($project);
            array_push($new_projects, $project);
            \Log::info($new_projects);
        }
        return $new_projects;
    }
}
