<?php

namespace App\Http\Controllers;

use App\Models\LatestGallery;

class LatestGalleryController extends Controller
{
    public function show($id)
    {
        $gallery = LatestGallery::findOrFail($id);

        return view('gallery.show', compact('gallery'));
    }
}