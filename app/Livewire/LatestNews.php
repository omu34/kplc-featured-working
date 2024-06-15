<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\LatestNews as News;

class LatestNews extends Component
{
    use WithFileUploads;

    public $news;
    public $newsFile;
    public $likes;
    public $description;
    public $link;
    public $views;


    protected $listeners = ['refreshNews' => '$refresh'];

    public function mount()
    {
        $this->news = News::latest()->take(4)->get();
    }

    public function toggleFeatured($newId)
    {
        $new = News::find($newId);
        $new->is_featured = !$new->is_featured;
        $new->save();

        $this->news = News::latest()->take(4)->get();
        $this->emit('refreshNews');
    }

    public function saveNews()
    {
        $this->validate([
            'newsFile' => 'required|mimetypes:video/mp4|max:10240,pdf,doc,docx,ppt,pptx,xls,xlsx|max:10240',
            'likes' => 'required|integer|max:2000',
            'views' => 'required|integer|max:2000',
            'description' => 'nullable|string',
            'link' => 'nullable|url',
        ]);

        $filePath = $this->newsFile->store('news', 'public');

        News::create([
            'description' => $this->description,
            'file_path' => $filePath,
            'link' => $this->link,
            'views' => 0,
            'likes' => 0,
            'is_featured' => false,
        ]);


        $this->news = News::latest()->take(4)->get();
        $this->emit('refreshNews');
        $this->resetInputFields();
    }

    private function resetInputFields()
    {
        $this->newsFile = null;
        $this->likes = null;
        $this->views = null;
        $this->description = null;
        $this->link = null;
    }

    public function render()
    {
        return view('livewire.latest-news', ['news' => $this->news]);
    }
}
