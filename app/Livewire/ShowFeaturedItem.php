<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LatestVideos;
use App\Models\LatestGallery;
use App\Models\LatestNews;
use App\Models\FeaturedItems;

class ShowFeaturedItem extends Component
{
    public $item;

    public function mount($id)
    {
        $featuredItem = FeaturedItems::findOrFail($id);

        if ($featuredItem->item_type === LatestVideos::class) {
            $this->item = LatestVideos::findOrFail($featuredItem->item_id);
        } elseif ($featuredItem->item_type === LatestGallery::class) {
            $this->item = LatestGallery::findOrFail($featuredItem->item_id);
        } elseif ($featuredItem->item_type === LatestNews::class) {
            $this->item = LatestNews::findOrFail($featuredItem->item_id);
        }
    }

    public function render()
    {
        return view('livewire.show-featured-item');
    }
}
