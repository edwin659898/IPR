<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Editstep extends Component
{
  public $steps =[];
  public function mount($steps)
  {
  $this->steps = $steps;
   }

    public function render()
    {
        return view('livewire.editstep');
    }
}
