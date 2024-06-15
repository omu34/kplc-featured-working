<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\LatestVideos;

class VideoComponent extends Component
{
    public $videos;

    public function mount($videos)
    {
        $this->videos = $videos;
    }

    public function toggleFeatured($id)
    {
        $video = LatestVideos::find($id);

        if ($video) {
            $video->is_featured = !$video->is_featured;
            $video->save();

            // Refresh the component data
            $this->videos = LatestVideos::find($id);
        }
    }

    public function render()
    {
        return view('livewire.video-component', [
            'videos' => $this->videos,
        ]);
    }
}
