<?php

// namespace App\Livewire;

// use Livewire\Component;
// use Livewire\WithFileUploads;
// use App\Models\LatestVideos as Videos;

// class LatestVideos extends Component
// {
//     use WithFileUploads; // Use the trait

//     public $videos;
//     public $videoFile;
//     public $likes;
//     public $description;
//     public $link;
//     public $views;

//     protected $listeners = ['refreshVideos' => '$refresh'];

//     public function mount()
//     {
//         $this->videos = Videos::all();
//     }

//     public function toggleFeatured($videoId)
//     {
//         $video = Videos::find($videoId);
//         $video->is_featured = !$video->is_featured;
//         $video->save();

//         $this->videos = Videos::all();
//         $this->emit('refreshVideos');
//     }

//     public function saveVideo()
//     {
//         $this->validate([
//             'videoFile' => 'required|mimetypes:video/mp4,video/quicktime,video/x-flv,video/webm,video/ogg,video/x-ms-wmv|max:10240',
//             'views' => 'required|integer|max:2000',
//             'description' => 'nullable|string',
//             'likes' => 'required|integer|max:2000',
//             'link' => 'nullable|url',
//         ]);

//         $filePath = $this->videoFile->store('videos', 'public');

//         Videos::create([
//             'title' => $this->title,
//             'description' => $this->description,
//             'file_path' => $filePath,
//             'link' => $this->link,
//             'views' => 0,
//             'likes' => 0,
//             'is_featured' => false,
//         ]);

//         // Refresh the videos list
//         $this->videos = Videos::all();
//         $this->emit('refreshVideos');
//         $this->resetInputFields();
//     }

//     private function resetInputFields()
//     {
//         $this->videoFile = null;
//         $this->likes = null;
//         $this->views = null;
//         $this->description = null;
//         $this->link = null;
//     }

//     public function render()
//     {
//         return view('livewire.latest-videos', ['videos' => $this->videos]);
//     }
// }





// app/Http/Livewire/LatestVideos.php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\LatestVideos as Videos;

class LatestVideos extends Component
{
    use WithFileUploads;

    public $videos;
    public $title;
    public $description;
    public $link;
    public $videoFile;

    protected $listeners = ['refreshVideos' => '$refresh'];

    public function mount()
    {
        $this->videos = Videos::all();
    }

    public function saveVideo()
    {
        $this->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
            'videoFile' => 'required|file|mimes:mp4|max:10240', // max 10MB
        ]);

        $filePath = $this->videoFile->store('videos', 'public');

        Videos::create([
            'title' => $this->title,
            'description' => $this->description,
            'link' => $this->link,
            'file_path' => $filePath,
        ]);

        $this->reset(['title', 'description', 'link', 'videoFile']);
        $this->videos = Videos::all();
    }

    public function toggleFeatured($videoId)
    {
        $video = Videos::find($videoId);
        $video->is_featured = !$video->is_featured;
        $video->save();

        // Refresh the videos list
        $this->videos = Videos::all();
        $this->emit('refreshVideos');
    }

    public function render()
    {
        return view('livewire.latest-videos', ['videos' => $this->videos]);
    }
}
