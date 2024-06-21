<?php

namespace App\Livewire;

use App\Models\LatestNews;
use Livewire\Component;

class ShowNewsItem extends Component
{

    public $item;
    public function mount($id)
    {
        $this->item = LatestNews::findOrFail($id);
    }


    public function render()
    {
        return view('livewire.show-news-item');
    }
}
