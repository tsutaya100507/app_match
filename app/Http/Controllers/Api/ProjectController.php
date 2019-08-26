<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
use App\Models\Message;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    // 案件と一緒にユーザーの情報を返すapi
    public function index()
    {
        $projects = Project::join('users', 'projects.user_id', '=', 'users.id')
                           ->select(
                               'users.name',
                               'projects.title',
                               'projects.id',
                               'projects.type',
                               'projects.description',
                               'projects.lower_price',
                               'projects.upper_price',
                               'projects.created_at'
                              )
                           ->orderBy('created_at', 'desc')
                           ->get();
        return $projects;
    }

    // 案件の更新
    public function update(Request $request)
    {
        \Log::info($request->title);
        \Log::info($request);
        $project = Project::find($request->id);
        $project->title = $request->title;
        $project->type = $request->type;
        $project->lower_price = $request->lower_price;
        $project->upper_price = $request->upper_price;
        $project->description = $request->description;
        $project->update();

        \Log::info($project);

        return response($project, 201);
    }

    // ログインユーザーの投稿した案件の一覧を取得
    public function getLoginUserProject(Request $request) {
        $projects = Project::join('users', 'projects.user_id', '=', 'users.id')
                           ->where('user_id', $request->user_id)
                           ->select('users.name',
                                    'projects.title',
                                    'projects.id',
                                    'projects.type',
                                    'projects.description',
                                    'projects.lower_price',
                                    'projects.upper_price',
                                    'projects.created_at')
                           ->orderBy('created_at', 'desc')
                           ->get();
        \Log::info($projects);

        return response($projects, 201);
    }

    // パブリックメッセージを投稿した案件の情報を返すapi
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
        
        // 取得した案件レコードに紐づく最新のパブリックメッセージを追加して新たな配列を作成。
        $new_projects = array();
        foreach($projects as $project)
        {
            $message = Message::join('users', 'messages.user_id', '=', 'users.id')
                              ->where('project_id', $project->id)
                              ->select('messages.body', 'messages.created_at', 'users.name')
                              ->latest()
                              ->first();

            $project['message'] = $message->body;
            $project['user_name'] = $message->name;
            \Log::info($project);
            array_push($new_projects, $project);
            \Log::info($new_projects);
        }
        return $new_projects;
    }
}
