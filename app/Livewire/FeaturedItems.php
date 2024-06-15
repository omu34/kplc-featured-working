<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LatestGallery;
use App\Models\LatestNews;
use App\Models\LatestVideos;

class FeaturedItems extends Component
{
    public $featuredItems;
    public $currentItems;

    public function mount()
    {
        $this->fetchFeaturedItems();
        $this->currentItems = $this->featuredItems->take(4);
    }

    public function fetchFeaturedItems()
    {
        $latestVideos = LatestVideos::where('is_featured', true)->latest()->take(4)->get();
        $latestGalleries = LatestGallery::where('is_featured', true)->latest()->take(4)->get();
        $latestNews = LatestNews::where('is_featured', true)->latest()->take(4)->get();

        $this->featuredItems = collect()
            ->merge($latestVideos)
            ->merge($latestGalleries)
            ->merge($latestNews)
            ->sortByDesc('created_at')
            ->take(12);
    }

    public function nextItems()
    {
        $this->currentItems = $this->featuredItems->splice(4)->take(4)->concat($this->featuredItems->take(4));
    }

    public function render()
    {
        return view('livewire.featured-items', ['currentItems' => $this->currentItems]);
    }
}
