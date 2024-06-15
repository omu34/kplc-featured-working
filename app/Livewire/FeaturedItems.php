<?php

// namespace App\Livewire;

// use Livewire\Component;
// use App\Models\LatestGallery;
// use App\Models\LatestNews;
// use App\Models\LatestVideos;

// class FeaturedItems extends Component
// {
//     public $currentItem;
//     protected $featuredItems;

//     public function mount()
//     {
//         $this->fetchFeaturedItems();
//         $this->currentItem = $this->featuredItems->first();
//     }

//     public function fetchFeaturedItems()
//     {
//         $latestVideos = LatestVideos::where('is_featured', true)->get();
//         $latestGalleries = LatestGallery::where('is_featured', true)->get();
//         $latestNews = LatestNews::where('is_featured', true)->get();

//         $this->featuredItems = collect()
//             ->merge($latestVideos)
//             ->merge($latestGalleries)
//             ->merge($latestNews)
//             ->sortByDesc('created_at')
//             ->take(4);
//     }

//     public function nextItem()
//     {
//         $currentIndex = $this->featuredItems->search($this->currentItem);
//         $nextIndex = ($currentIndex + 1) % $this->featuredItems->count();
//         $this->currentItem = $this->featuredItems[$nextIndex];
//     }



//     public function render()
//     {
//         return view('livewire.featured-items', ['currentItem' => $this->currentItem]);
//     }
// }








namespace App\Livewire;

use Livewire\Component;
use App\Models\LatestGallery;
use App\Models\LatestNews;
use App\Models\LatestVideos;

class FeaturedItems extends Component
{
    public $currentItem;
    protected $featuredItems;

    public function mount()
    {
        $this->fetchFeaturedItems();
        $this->currentItem = $this->featuredItems->first();
    }

    public function fetchFeaturedItems()
    {
        $latestVideos = LatestVideos::where('is_featured', true)->get();
        $latestGalleries = LatestGallery::where('is_featured', true)->get();
        $latestNews = LatestNews::where('is_featured', true)->get();

        $this->featuredItems = collect()
            ->merge($latestVideos)
            ->merge($latestGalleries)
            ->merge($latestNews)
            ->sortByDesc('created_at')
            ->take(4);
    }

    public function nextItem()
    {
        $currentIndex = $this->featuredItems->search($this->currentItem);
        $nextIndex = ($currentIndex + 1) % $this->featuredItems->count();
        $this->currentItem = $this->featuredItems[$nextIndex];
    }

    public function render()
    {
        return view('livewire.featured-items', ['currentItem' => $this->currentItem]);
    }
}
