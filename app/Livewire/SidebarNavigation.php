<?php

namespace App\Livewire;

use Livewire\Component;

class SidebarNavigation extends Component
{
    public $mobileMenuOpen = false;

    public function toggleMobileMenu()
    {
        $this->mobileMenuOpen = !$this->mobileMenuOpen;
    }

    public function closeMobileMenu()
    {
        $this->mobileMenuOpen = false;
    }

    public function render()
    {
        return view('livewire.sidebar-navigation');
    }
}
