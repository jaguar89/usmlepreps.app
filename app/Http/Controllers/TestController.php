<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\Test;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tests = Test::paginate(9);
        return view('admin.tests', ['tests' => $tests]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $systems = System::all();
        return view('admin.create_test', ['systemObjects' => $systems]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'system' => 'required|string',
            'test_content' => 'required|string',
        ]);

        $test = new Test();
        $test->system_id = $request->system;
        $test->content = $request->test_content;
        $test->save();

        $this->assignAllUserstoTest($test);

        return redirect()->route('tests')->with('success', 'Test content has been successfully added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $system = System::with('tests')->find($id);
        $tests = $system->tests;
        return view('details', ['tests' => $tests]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Test $test)
    {
        $systems = System::all();
        return view('admin.edit_test', ['test' => $test , 'systemObjects' => $systems]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        $request->validate([
            'system' => 'required|string',
            'test_content' => 'required|string',
        ]);

        $test->system_id = $request->system;
        $test->content = $request->test_content;
        $test->save();

        return redirect()->route('tests')->with('success', 'Test content has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        System::destroy($id);
        return redirect()->route('tests')->with('success', 'Test has been successfully deleted!');
    }

    public function completeTest($testId){
        $userId = \request('user_id');
       if(! $userId == Auth::user()->id)
           return 'false';
        $user = User::find($userId);
        $user->tests()->attach($testId , ['completed' => true]);
        return ['systemId' => \request('system_id')];
    }

    private function assignAllUserstoTest(Test $test)
    {
        $users = User::where('is_admin', false)->get();
        foreach ($users as $user) {
            $user->tests()->attach($test->id, ['completed' => false]);
        }
    }
}
