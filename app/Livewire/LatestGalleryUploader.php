<?php

namespace App\Livewire;

use App\Models\LatestGallery;
use App\Models\LatestVideos;
use Livewire\Component;
use Livewire\WithFileUploads;

class LatestGalleryUploader extends Component
{
    use WithFileUploads;

    public $gallery;
    public $galleryFile;
    public $likes;
    public $description;
    public $link;
    public $views;


    protected $listeners = ['refreshGallery' => '$refresh'];

    public function mount()
    {
        $this->gallery = LatestGallery::latest()->take(4)->get();
    }

    public function toggleFeatured($galleryId)
    {
        $gallery = LatestGallery::find($galleryId);
        $gallery->is_featured = !$gallery->is_featured;
        $gallery->save();

        $this->gallery = LatestGallery::latest()->take(4)->get();
        $this->emit('refreshNews');
    }

    public function saveGallery()
    {
        $this->validate([
            'galleryFile' => 'required|mimetypes:video/mp4,video/mpeg,video/ogg,video/quicktime,video/webm,video/x-ms-wmv,video/x-msvideo,audio/mpeg,audio/mp3,image/png,image/jpeg,image/gif,pdf,doc,docx,ppt,pptx,xls,xlsx,zip,csv|max:10240',
            'likes' => 'required|integer|max:2000',
            'views' => 'required|integer|max:2000',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
        ]);

        $filePath = $this->newsFile->store('gallery', 'public');

        LatestGallery::create([
            'description' => $this->description,
            'file_path' => $filePath,
            'link' => $this->link,
            'views' => 0,
            'likes' => 0,
            'is_featured' => false,
        ]);


        $this->gallery = LatestGallery::latest()->take(4)->get();
        $this->emit('refreshGallery');
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->galleryFile = null;
        $this->likes = null;
        $this->views = null;
        $this->description = null;
        $this->link = null;
    }

    public function render()
    {
        return view('livewire.latest-gallery-uploader', ['gallery' => $this->gallery]);
    }
}