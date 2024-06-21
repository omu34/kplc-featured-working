<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\MainPages;
use App\Models\SubPages;
use App\Models\PageContents;

class MainPageComponent extends Component
{
    use WithFileUploads;

    public $mainPage;
    public $subPages;
    public $selectedSubPage;
    public $pageContent;
    public $media;
    public $mediaType;
    public $selectedSubPageId;
    public $selectedPageContentId;

    public function mount(MainPages $mainPage)
    {
        $this->mainPage = $mainPage;
        $this->subPages = $mainPage->subPages()->with('pageContent')->get();
    }

    public function render()
    {
        return view('livewire.main-page', [
            'mainPage' => $this->mainPage,
            'subPages' => $this->subPages,
            'selectedSubPage' => $this->selectedSubPage,
        ]);
    }

    public function updateSelectedSubPage($subPageId)
    {
        $this->selectedSubPage = SubPages::with('pageContent')->find($subPageId);
        $this->selectedPageContentId = optional($this->selectedSubPage->pageContent)->id;
    }

    public function uploadMedia()
    {
        $this->validate([
            'media' => 'image|max:1024',  // 1MB Max
            'mediaType' => 'required|in:mainPage,subPage,pageContent',
        ]);

        $path = $this->media->store('media');

        switch ($this->mediaType) {
            case 'mainPage':
                $this->mainPage->update(['media' => $path]);
                break;

            case 'subPage':
                $subPage = SubPages::find($this->selectedSubPageId);
                if ($subPage) {
                    $subPage->update(['media' => $path]);
                }
                break;

            case 'pageContent':
                $pageContent = PageContents::find($this->selectedPageContentId);
                if ($pageContent) {
                    $pageContent->update(['media' => $path]);
                }
                break;
        }
    }
}
