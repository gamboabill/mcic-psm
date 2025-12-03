<?php

namespace App\Livewire;

use Livewire\Attributes\On;
use Livewire\Component;

class FlashAlert extends Component
{
    public $message = '';
    public $type = 'success';
    public $show = false;

    #[On('showAlert')]
    public function showAlert($type, $message)
    {
        $this->type = $type;
        $this->message = $message;
        $this->show = true;
    }

    public function hideAlert()
    {
        $this->show = false;
    }

    public function render()
    {
        return view('livewire.flash-alert');
    }
}
