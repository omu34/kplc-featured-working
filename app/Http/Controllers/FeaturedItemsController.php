<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LatestVideos;
use App\Models\LatestGallery;
use App\Models\LatestNews;
use App\Models\FeaturedItems;

class FeaturedItemsController extends Controller
{
    public function index()
    {
        $latestVideos = LatestVideos::where('is_featured', true)->latest()->take(4)->get();
        $latestNews = LatestNews::where('is_featured', true)->latest()->take(4)->get();
        $latestGallery = LatestGallery::where('is_featured', true)->latest()->take(4)->get();

        $allItems = $latestVideos->merge($latestNews)->merge($latestGallery);

        $featuredItems = $allItems->sortByDesc('created_at')->take(4);

        return view('featured.index', compact('featuredItems'));
    }

    public function show($id)
    {
        $featuredItem = FeaturedItems::findOrFail($id);

        $item = null;
        if ($featuredItem->item_type === 'App\\Models\\LatestVideos') {
            $item = LatestVideos::findOrFail($featuredItem->item_id);
        } elseif ($featuredItem->item_type === 'App\\Models\\LatestGallery') {
            $item = LatestGallery::findOrFail($featuredItem->item_id);
        } elseif ($featuredItem->item_type === 'App\\Models\\LatestNews') {
            $item = LatestNews::findOrFail($featuredItem->item_id);
        }

        return view('featured.show', compact('item'));
    }
}
