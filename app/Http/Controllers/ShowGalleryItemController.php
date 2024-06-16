<?php

namespace App\Http\Controllers;


class ShowGalleryItemController extends Controller
{
    public function show($id)
    {
        return view('gallery.show', compact('id'));
    }
}