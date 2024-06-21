<?php

namespace App\Http\Controllers;


use App\Models\LatestNews;

class NewsToggleController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $newsItem = LatestNews::findOrFail($id);
        $item = $newsItem->item;

        return view('news.show', compact('item'));
    }
}