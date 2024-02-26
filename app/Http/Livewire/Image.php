<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Image extends Component
{

    public $images = [];
    
    public function mount($images)
    {
        $this->images = $images;
    }

    public function render()
    {
        return view('livewire.image');
    }
}
