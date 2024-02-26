<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Step extends Component
{
    public $steps =[];
    public function increament()
    {
        $this -> steps[] = count($this -> steps);
    }

    public function remove($index)
    {
        unset($this -> steps[$index]);
    }

    public function render()
    {
        return view('livewire.step');
    }
}
