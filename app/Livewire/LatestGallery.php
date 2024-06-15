<?php

namespace App\Livewire;

use App\Models\LatestGallery as Gallery;
use Livewire\Component;
use Livewire\WithFileUploads;

class LatestGallery extends Component
{
    use WithFileUploads;

    public $gallery;
    public $galleryFile;
    public $likes;
    public $description;
    public $link;
    public $views;


    protected $listeners = ['refresGallery' => '$refresh'];

    public function mount()
    {
        $this->gallery = Gallery::latest()->take(4)->get();
    }

    public function toggleFeatured($galleryId)
    {
        $gallery = Gallery::find($galleryId);
        $gallery->is_featured = !$gallery->is_featured;
        $gallery->save();

        $this->gallery = Gallery::latest()->take(4)->get();
        $this->emit('refreshNews');
    }

    public function saveGallery()
    {
        $this->validate([
            'galleryFile' => 'required|mimetypes:video/mp4|max:10240,pdf,doc,docx,ppt,pptx,xls,xlsx|max:10240',
            'likes' => 'required|integer|max:2000',
            'views' => 'required|integer|max:2000',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
        ]);

        $filePath = $this->newsFile->store('gallery', 'public');

        Gallery::create([
            'description' => $this->description,
            'file_path' => $filePath,
            'link' => $this->link,
            'views' => 0,
            'likes' => 0,
            'is_featured' => false,
        ]);


        $this->gallery = Gallery::latest()->take(4)->get();
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
        return view('livewire.latest-gallery', ['gallery' => $this->gallery]);
    }
}
