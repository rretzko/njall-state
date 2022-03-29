<?php

namespace App\Http\Livewire\Listeners;

use App\Models\Event;
use Livewire\Component;

class EventListener extends Component
{
    public $event;

    protected $listeners = ['newevent' => 'updateCurrentEvent'];

    public function render()
    {
        return view('livewire.listeners.event-listener');
    }

    public function updateCurrentEvent($year_of)
    {
        $this->event = Event::where('year_of',$year_of)->first();
    }
}
