<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Project;
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
        $projects = Project::where('user_id', $request->user_id)->get();

        return response($projects, 201);
    }
}
