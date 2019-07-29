<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Application;

class ApplicationController extends Controller
{
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
