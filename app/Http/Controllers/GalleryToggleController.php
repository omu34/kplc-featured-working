<?php

namespace App\Http\Controllers;

use App\Models\LatestGallery;

class GalleryToggleController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $galleryItem = LatestGallery::findOrFail($id);
        $item = $galleryItem->item;

        return view('gallery.show', compact('item'));
    }
}