<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\Test;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $systems = System::paginate(9);
        return view('welcome' , ['systemObjects' => $systems]);
    }

    public function viewDetails($id){
        $tests = Test::where('system_id' , $id)->get();
        return view('details' , ['tests' => $tests]);
    }
}
