<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        $systems = System::paginate(9);
        return view('welcome' , ['systemObjects' => $systems]);
    }

    public function viewDetails(){
        return view('details');
    }
}
