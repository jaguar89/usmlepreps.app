<?php

namespace App\Http\Controllers;

use App\Models\System;
use App\Models\Test;
use App\Models\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
            'title' => 'required|string',
            'test_content' => 'required|string',
            'material' => 'nullable|file|mimes:zip,rar',
            'questions_ids' => 'nullable|string|regex:/^\d+(,\d+)*$/',

        ]);

        $test = new Test();

        if ($request->hasFile('material') && $request->file('material')->isValid()) {
            $filePath = $request->file('material')->store('materials', 'public');
            $test->material = $filePath;
        }

        $test->system_id = $request->system;
        $test->title = $request->title;
        $test->content =$request->test_content;
        $test->questions_ids = $request->has('questions_ids') ? $request->input('questions_ids') : null;
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
        return view('admin.edit_test', ['test' => $test, 'systemObjects' => $systems]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Test $test)
    {
        $request->validate([
            'system' => 'required|string',
            'title' => 'required|string',
            'test_content' => 'required|string',
            'material' => 'nullable|file|mimes:zip,rar',
            'questions_ids' => 'nullable|string|regex:/^\d+(,\d+)*$/',
        ]);

        if ($request->hasFile('material') && $request->file('material')->isValid()) {
            if ($test->material) {
                Storage::disk('public')->delete($test->material);
            }
            $filePath = $request->file('material')->store('materials', 'public');
            $test->material = $filePath;
        }

        $test->system_id = $request->system;
        $test->title = $request->title;
        $test->content = $request->test_content;
        $test->questions_ids = $request->has('questions_ids') ? $request->input('questions_ids') : null;
        $test->save();

        return redirect()->route('tests')->with('success', 'Test content has been successfully updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Test $test)
    {
        try {
            if ($test->material && Storage::disk('public')->exists($test->material)) {
                Storage::disk('public')->delete($test->material);
            }
            $test->delete();
            return redirect()->route('tests')->with('success', 'Test has been successfully deleted!');
        } catch (\Exception $e) {
            return redirect()->route('tests')->with('error', 'An error occurred while deleting the test.');
        }
    }

    public function completeTest($testId)
    {
        $userId = \request('user_id');
        if (!$userId == Auth::user()->id) {
            return response()->json(false);
        }
        $user = User::find($userId);
        if (!$user->tests->contains($testId)) {
            // Pivot record doesn't exist, so attach a new one
            $user->tests()->attach($testId, ['completed' => true]);
        } else {
            // Pivot record exists, so update the existing pivot
            $user->tests()->updateExistingPivot($testId, ['completed' => true]);
        }
        return ['systemId' => \request('system_id')];
    }

    public function incompleteTest($testId)
    {
        $userId = \request('user_id');
        if (!$userId == Auth::user()->id) {
            return response()->json(false);
        }
        $user = User::find($userId);
        $user->tests()->updateExistingPivot($testId, ['completed' => false]);
        return ['systemId' => \request('system_id')];
    }

    private function assignAllUserstoTest(Test $test)
    {
        $users = User::where('is_admin', false)->get();
        foreach ($users as $user) {
            $user->tests()->attach($test->id, ['completed' => false]);
        }
    }

    public function downloadMaterial(Test $test)
    {
        if ($test->material && Storage::disk('public')->exists($test->material)) {
            return Storage::disk('public')->download($test->material);
        } else {
            return redirect()->back()->with('error', 'Material not found.');
        }
    }
}
