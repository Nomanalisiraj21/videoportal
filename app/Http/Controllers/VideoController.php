<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $video = Video::all();
        return view('admin.video.index', ['video' => $video]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.video.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $this->validate(
            $request,
            [
                "title" => 'required|max:255',
                "category_id" => "required",
                "ar_title" => 'required',
                'Videofile' => 'mimetypes:video/avi,video/mpeg,video/quicktime,video/mp4',
                "thumbnail" => 'mimes:jpg,bmp,png'
            ]
        );


        $imageName = time() . '.' . $request->thumbnail->extension();
        $request->thumbnail->move(public_path('storage/video/thumb'), $imageName);

        $videoName = time() . '.' . $request->Videofile->extension();
        $request->Videofile->move(public_path('storage/video/video'), $videoName);

        $video = new Video();
        $video->thumbnail = $imageName;
        $video->title = $request->title ?? '';
        $video->description = $request->description ?? '';
        $video->category_id = $request->category_id;
        $video->ar_title = $request->ar_title ?? '';
        $video->ar_description = $request->ar_description ?? '';
        $video->Videofile = $videoName;
        $video->save();

        return redirect()->route('video.index')->with('success', 'Video added Successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function edit(Video $video)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Video $video)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy(Video $video)
    {
        //
    }
}
