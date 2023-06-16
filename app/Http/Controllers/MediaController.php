<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Media::latest()->paginate(5);

        return view('videos.index', compact('videos'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('videos.form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if ($request->hasFile('video')) {

            $file = $request->file('video');
            $path = 'videos/';
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = 'webm';
            $fileNameToStore = preg_replace('/\s+/', '_', $filename . '_' . time() . '.' . $extension);

            \Storage::disk('public')->putFileAs($path, $file, $fileNameToStore);

            $media = Media::create(['file_name' => $fileNameToStore]);

            return  response()->json(['success' => ($media) ? 1 : 0, 'message' => ($media) ? 'Video uploaded successfully.' : "Some thing went wrong. Try again !."]);
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Media  $media
     * @return \Illuminate\Http\Response
     */
    public function destroy($media)
    {
        $media = Media::find($media);

        if (isset($media->file_name) && !empty($media->file_name)) {
            $path = 'videos/';
            $store_path = $path . $media->file_name;
            \Storage::disk('public')->delete($store_path);
        }
        $media->delete();

        return redirect()->route('videos.index')
            ->with('success', 'video deleted successfully');
    }
}