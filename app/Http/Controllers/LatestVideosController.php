<?php // app/Http/Controllers/VideoController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LatestVideos;

class LatestVideosController extends Controller
{
    public function show($id)
    {
        $video = LatestVideos::findOrFail($id);

        return view('videos.show', compact('video'));
    }
}
