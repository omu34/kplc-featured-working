<?php // app/Http/Controllers/VideoController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LatestGallery;

class LatestGalleryController extends Controller
{
    public function show($id)
    {
        $gallery = LatestGallery::findOrFail($id);

        return view('gallery.show', compact('gallery'));
    }
}
