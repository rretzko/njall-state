<?php

namespace App\Http\Livewire\Templates;

use Livewire\Component;

class ParticipantsComponent extends Component
{
    public $event;

    public function render()
    {
        return view('livewire.templates.participants-component');
    }
}
