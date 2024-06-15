<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LatestNews;

class NewsComponent extends Component
{
    public $news;

    public function mount($news)
    {
        $this->news = $news;
    }

    public function toggleFeatured($id)
    {
        $new = LatestNews::find($id);

        if ($new) {
            $new->is_featured = !$new->is_featured;
            $new->save();

            // Refresh the component data
            $this->news = LatestNews::find($id);
        }
    }

    public function render()
    {
        return view('livewire.news-component', [
            'news' => $this->news,
        ]);
    }
}
