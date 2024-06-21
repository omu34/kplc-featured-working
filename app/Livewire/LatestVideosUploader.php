<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\LatestVideos as Videos;

class LatestVideosUploader extends Component
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
            'videoFile' => 'required|mime-types:video/mp4,video/mpeg,video/ogg,video/quicktime,video/webm,video/x-ms-wmv,video/x-msvideo|max:10240', // max 10MB
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

        $this->videos = Videos::all();
        $this->emit('refreshVideos');
    }

    public function render()
    {
        return view('livewire.latest-videos-uploader', ['videos' => $this->videos]);
    }
}
