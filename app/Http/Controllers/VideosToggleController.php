<?php

namespace App\Http\Controllers;


use App\Models\LatestVideos;

class VideosToggleController extends Controller
{
    public function show($id)
    {
        $videosItem = LatestVideos::findOrFail($id);
        $item = $videosItem->item;

        return view('videos.show', compact('item'));
    }
}