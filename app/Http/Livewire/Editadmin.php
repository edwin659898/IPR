<?php

namespace App\Http\Livewire;
use App\supplier;
use Livewire\Component;

class Editadmin extends Component
{

  public $steps =[];
  public $supplier;
  public function mount($steps)
  {
  $this->steps = $steps;
   }
    public function render()
    {
       $this->supplier = supplier::all();
        return view('livewire.editadmin');
    }
}
