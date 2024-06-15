<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LatestGallery;

class GalleryComponent extends Component
{
    public $gallery;

    public function mount($gallery)
    {
        $this->gallery = $gallery;
    }

    public function toggleFeatured($id)
    {
        $galla = LatestGallery::find($id);

        if ($galla) {
            $galla->is_featured = !$galla->is_featured;
            $galla->save();

            // Refresh the component data
            $this->gallery = LatestGallery::find($id);
        }
    }

    public function render()
    {
        return view('livewire.gallery-component', [
            'gallery' => $this->gallery,
        ]);
    }
}
