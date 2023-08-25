<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::paginate(4);
        return view('admin.videos', ['videos' => $videos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'videoFile' => 'required|file|mimes:mp4,mov,avi,flv,wmv',
            'title' => 'nullable|string',
            'thumbnail' => 'nullable|file|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $file = $request->file('videoFile');
        $filePath = $file->store('videos', 'public');

        $thumbnail = null;
        if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
            $thumbnailFile = $request->file('thumbnail');
            $thumbnail = $thumbnailFile->store('videos/thumbnails', 'public');
        }

        $video = new Video();
        $video->path = $filePath;
        $video->title = $request->has('title') && $request->get('title') != '' ? $request->get(
            'title'
        ) : $request->file('videoFile')->getClientOriginalName();
        $video->thumbnail = $thumbnail;
        $video->save();

        $this->assignAllUserstoVideo($video);

        return redirect()->route('videos')->with('success', 'A new Video was added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $videos = Video::where('id', $id)->get();
        return view('single-video', ['videos' => $videos]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $video = Video::find($id);
        if ($video) {
            $thumbnail = $video->thumbnail;
            if ($thumbnail && Storage::disk('public')->exists($thumbnail)) {
                Storage::disk('public')->delete($thumbnail);
            }
            Storage::disk('public')->delete($video->path);
            $video->delete();
            return redirect()->route('videos')->with('success', 'Video was deleted successfully.');
        }
        return redirect()->route('videos');
    }

    public function getVideoTitle($id)
    {
        $video = Video::where('id', $id)->select('title')->get();
        if ($video) {
            return response()->json($video->title);
        } else {
            return response()->json(['error' => 'Test not found'], 404);
        }
    }

    private function assignAllUserstoVideo(Video $video)
    {
        $users = User::all();
        foreach ($users as $user) {
            $user->videos()->attach($video->id , ['watched' => false]);
        }
    }

    public function markVideoAsWatched($id){
        $user = Auth::user();
        $video = $user->videos()->where('video_id' , $id)->first();
        if($video)
            $user->videos()->updateExistingPivot($video->pivot->video_id , ['watched' => true]);

        return response()->json(true);
    }
}
