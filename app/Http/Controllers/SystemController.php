<?php

namespace App\Http\Controllers;

use App\Models\System;
use Illuminate\Http\Request;

class SystemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $systems = System::paginate(9);
        return view('admin.index', ['systems' => $systems]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.create_system');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            'category_name' => 'required|string|max:255', // Category name validation
        ]);

        $imagePath = '';
        // If the image is valid and exists, store it
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('system_objects', 'public');
        }
        // Create the system object and save to database
        $systemObject = new System();
        $systemObject->image_path = $imagePath;
        $systemObject->name = $request->category_name;
        $systemObject->save();

        // Redirect to a desired location with a success message
        return redirect()->route('systems')->with('success', 'System was created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(System $system)
    {
        return view('admin.edit_system', ['system' => $system]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, System $system)
    {
        // Validate the incoming request
        $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // Image validation
            'category_name' => 'required|string|max:255', // Category name validation
        ]);;
        // If the image is valid and exists, store it
        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $imagePath = $request->file('image')->store('system_objects', 'public');
            $system->image_path = $imagePath;
        }

        $system->name = $request->category_name;
        $system->save();

        // Redirect to a desired location with a success message
        return redirect()->route('systems')->with('success', 'System was updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        System::destroy($id);
        return redirect()->route('systems')->with('success', 'System object deleted successfully.');
    }
}
