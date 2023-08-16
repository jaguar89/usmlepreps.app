<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\Test;
use Illuminate\Http\Request;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tests = Test::paginate(9);
        return view('admin.tests_index', ['tests' => $tests]);
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
}
