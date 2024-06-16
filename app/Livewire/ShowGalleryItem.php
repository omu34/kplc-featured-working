<?php

namespace App\Livewire;

use App\Models\LatestGallery;
use Livewire\Component;

class ShowGalleryItem extends Component
{
    public $item;

    public function mount($id)
    {
        $this->item = LatestGallery::findOrFail($id);
    }

    public function render()
    {
        return view('livewire.show-gallery-item', ['item' => $this->item]);
    }
}
