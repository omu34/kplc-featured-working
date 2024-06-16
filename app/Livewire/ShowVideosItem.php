<?php

namespace App\Livewire;

use App\Models\LatestVideos;
use Livewire\Component;

class ShowVideosItem extends Component
{

    public $item;
    public function mount($id)
    {
        $this->item = LatestVideos::findOrFail($id);
    }
    public function render()
    {
        return view('livewire.show-videos-item');
    }
}
