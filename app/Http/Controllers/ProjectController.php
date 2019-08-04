<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Models\Room;

class ProjectController extends Controller
{
    // 投稿一覧
    public function index()
    {
        return view('project/index');
    }

    // 投稿詳細
    public function show($id)
    {
        \Log::info($id);
        $project = Project::where('projects.id', $id)->join('users', 'projects.user_id', '=', 'users.id')
                        ->select('users.id as user_id','users.name','projects.title','projects.id','projects.type','projects.description')
                        ->get();
        $user = Auth::user();

        // 同じユーザーの組み合わせで作成されたDMルームを検索する。
        $match1 = ['send_user_id' => $user->id, 'recieve_user_id' => $project[0]->user_id];
        $match2 = ['send_user_id' => $project[0]->user_id, 'recieve_user_id' => $user->id];
        $room = Room::where($match1)->orWhere($match2)->get();
        \Log::info($room);
        \Log::info($project);
        return view('project/show', ['project' => $project, 'user' => $user, 'room' => $room]);
    }

    // 新規投稿
    public function create()
    {
        return view('project/create');
    }

    // 新規保存
    public function store(Request $request)
    {
        \Log::info('ログ出力テスト');
        $project = new Project();
        $project->title = $request->title;
        $project->type = $request->type;
        $project->lower_price = $request->lower_price;
        $project->upper_price = $request->upper_price;
        $project->description = $request->description;
        $project->user_id = $request->user_id;
        \Log::info($project);
        $project->save();
        response($project, 201);
        // return redirect()->action('ProjectController@show', ['id' => 5]);;
        // return view('project/store');
    }

    // 投稿した案件一覧
    public function postedProjects()
    {
        $user = Auth::user();
        return view('project/posted', ['user' => $user]);
    }

    // 投稿した案件一覧
    public function appliedProjects()
    {
        return view('project/applied');
    }
}