<?php

namespace App\Http\Livewire;

use Livewire\Component;

class Comments extends Component
{
    public $newComment;
    public $comment=[

      [
        'body'=>'Lorem ipsum dolor sit amet, id ultricies vulputate.',
          'created_at'=> '3 min ago',
          'creator'=>'mike njogu'
      ]
    ];


    public function addComment()
    {
        $this -> comment[]=[
          'body'=>'New Comment.',
            'created_at'=> '2 min ago',
            'creator'=>'mikeDee'
        ];
    }

    public function render()
    {
        return view('livewire.comments');
    }
}
