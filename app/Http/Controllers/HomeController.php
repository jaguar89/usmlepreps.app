<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\Test;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $totalUsers = User::where('is_admin', false)->get()->count();
        $totalSystems = System::all()->count();
        $totalTasks = Test::all()->count();
        $totalVideos = Video::all()->count();
        $systems = System::paginate(9);
        return view('welcome', [
            'systemObjects' => $systems,
            'totalUsers' => $totalUsers,
            'totalSystems' => $totalSystems,
            'totalTasks' => $totalTasks,
            'totalVideos' => $totalVideos
        ]);
    }

    public function viewSystemTasks($id)
    {
        $tests = Test::where('system_id', $id)->get();
        return view('details', ['tests' => $tests]);
    }

    public function viewSingleTask($params)
    {
        parse_str(urldecode($params), $output);
        $id = $output['id'];
        $title = $output['title'];
        $test = Test::find($id);
        return view('single_task', ['test' => $test]);
    }

    public function viewAllVideos()
    {
        $videos = Video::paginate(15);
        return view('videos', ['videos' => $videos]);
    }
}
