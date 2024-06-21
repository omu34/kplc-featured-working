<?php

namespace App\Livewire;

use Livewire\Component;

use App\Models\Navbar;

class NavbarSelector extends Component
{
    public $selectedNavbar = 'top'; // Default selection
    public $items;

    public function mount()
    {
        $this->loadNavbarItems();
    }

    public function updatedSelectedNavbar()
    {
        $this->loadNavbarItems();
    }

    public function loadNavbarItems()
    {
        $this->items = Navbar::where('type', $this->selectedNavbar)->orderBy('order')->get();
    }

    public function render()
    {
        return view('livewire.navbar-selector', [
            'items' => $this->items,
            'selectedNavbar' => $this->selectedNavbar
        ]);
    }
}
