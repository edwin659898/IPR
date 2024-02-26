<?php

namespace App\Http\Livewire;

use Livewire\Component;

class EditHod extends Component
{

  public $steps =[];
  public function mount($steps)
  {
  $this->steps = $steps;
   }
    public function render()
    {
        return view('livewire.edit-hod');
    }
}
