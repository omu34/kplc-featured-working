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

    public $page;
    public $pagesections;
    public $selectedPagesection;
    public $media;
    public $mediaType;
    public $selectedPagesectionId;
    public $selectedPagecontentId;

    public function mount(Page $page)
    {
        $this->page = $page;
        $this->pagesections = $page->pagesections()->with('pagecontents')->get();
    }

    public function render()
    {
        return view('livewire.page-component', [
            'page' => $this->page,
            'pagesections' => $this->pagesections,
            'selectedPagesection' => $this->selectedPagesection,
        ]);
    }

    public function updateSelectedPagesection($selectedPagesectionId)
    {
        $this->selectedPagesection = Pagesection::with('pagecontents')->find($selectedPagesectionId);
        $this->selectedPagecontentId = optional($this->selectedPagesection->pagecontents->first())->id;
    }

    public function uploadMedia()
    {
        $this->validate([
            'media' => 'image|max:1024',  // 1MB Max
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
