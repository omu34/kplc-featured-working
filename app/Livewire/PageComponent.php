<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Page;
use App\Models\Pagesection;
use App\Models\Pagecontent;

class PageComponent extends Component
{
    use WithFileUploads;

    public $pages;
    public $page;
    public $pagesections;
    public $selectedPagesection;
    public $media;
    public $mediaType;
    public $selectedPageId;
    public $selectedPagesectionId;
    public $selectedPagecontentId;

    public function mount()
    {
        $this->pages = Page::all();
        if ($this->pages->isNotEmpty()) {
            $this->selectedPageId = $this->pages->first()->id;
            $this->loadPageData();
        }
    }

    public function render()
    {
        return view('livewire.page-component', [
            'pages' => $this->pages,
            'page' => $this->page,
            'pagesections' => $this->pagesections,
            'selectedPagesection' => $this->selectedPagesection,
        ]);
    }

    public function loadPageData()
    {
        $this->page = Page::with('pagesections.pagecontents')->find($this->selectedPageId);
        $this->pagesections = $this->page->pagesections;
        $this->selectedPagesection = null;
        $this->selectedPagesectionId = null;
        $this->selectedPagecontentId = null;
    }

    public function updatedSelectedPageId()
    {
        $this->loadPageData();
    }

    public function updateSelectedPagesection($selectedPagesectionId)
    {
        $this->selectedPagesection = Pagesection::with('pagecontents')->find($selectedPagesectionId);
        $this->selectedPagecontentId = optional($this->selectedPagesection->pagecontents->first())->id;
    }

    public function uploadMedia()
    {
        $this->validate([
            'media' => 'image|max:1024',
            'mediaType' => 'required|in:page,pagesection,pagecontent',
        ]);

        $path = $this->media->store('media');

        switch ($this->mediaType) {
            case 'page':
                $this->page->update(['media' => $path]);
                break;

            case 'pagesection':
                $pagesection = Pagesection::find($this->selectedPagesectionId);
                if ($pagesection) {
                    $pagesection->update(['media' => $path]);
                }
                break;

            case 'pagecontent':
                $pagecontent = Pagecontent::find($this->selectedPagecontentId);
                if ($pagecontent) {
                    $pagecontent->update(['media' => $path]);
                }
                break;
        }
    }
}

