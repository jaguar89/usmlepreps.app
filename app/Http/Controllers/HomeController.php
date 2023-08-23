<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\Test;
use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;

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

    public function viewTaskById($id , $task_id)
    {
        $test = Test::where('id', $task_id)->first();
        if ($test) {
            return response()->json($test);
        } else {
            return response()->json(['error' => 'Test not found'], 404);
        }
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

    public function ss(){
        $test_id = \request()->get('taskId');
        $user_email = \request()->get('email'); // Assuming you are sending the email as a parameter

        $user = User::where('email', $user_email)->first();

        if ($user) {
            $test = $user->tests()->where('test_id', $test_id)->first();

            if ($test) {
                $completed = $test->pivot->completed;
                return response()->json(['success' => $completed]);
            }
        }

        return response()->json(['success' => false], 404); // Test not found or user not found

    }
}
