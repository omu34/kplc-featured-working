<?php

namespace App\Http\Controllers;


class ShowNewsItemController extends Controller
{
    public function show($id)
    {
        return view('news.show', compact('id'));
    }
}
