<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Application;

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
        $application = new Application();
        $application->user_id    = $request->user_id;
        $application->project_id = $request->project_id;
        $application->save();
    }
}
