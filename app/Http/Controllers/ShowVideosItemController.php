<?php

namespace App\Http\Controllers;


class ShowVideosItemController extends Controller
{
    public function show($id)
    {
        return view('videos.show', compact('id'));
    }
}