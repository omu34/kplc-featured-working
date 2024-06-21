<?php

namespace App\Livewire;

use App\Models\Footers;
use Livewire\Component;

class FooterSelector extends Component
{

    public $selectedFooter = 'quickLinks'; 
    public $items;

    public function mount()
    {
        $this->loadFooterItems();
    }

    public function updatedSelectedFooter()
    {
        $this->loadFooterItems();
    }

    public function loadFooterItems()
    {
        $this->items = Footers::where('type', $this->selectedFooter)->orderBy('order')->get();
    }

    public function render()
    {
        return view('livewire.footer-selector', [
            'items' => $this->items,
            'selectedFooter' => $this->selectedFooter
        ]);
    }
   
}