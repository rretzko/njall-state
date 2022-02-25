<?php

namespace App\Http\Livewire\Guest;

use App\Models\Event;
use App\Models\Participant;
use Illuminate\Database\Eloquent\Collection;
use Livewire\Component;

class YearComponent extends Component
{
    public $event = NULL;
    public $events = NULL;
    public $firstevent = NULL;
    public $lastevent = NULL;
    public $selectoryear = 7;

    public function mount()
    {
        $this->events = Event::orderByDesc('year_of')->get();
        $this->event = $this->events->first();
        $this->firstevent = $this->events->first();
        $this->lastevent = $this->events->last();
        $this->selectoryear = $this->event->id;
    }

    public function render()
    {
        return view('livewire.guest.year-component',
            [
                'participants' => Participant::where('event_id', $this->event->id)->get(),
            ]);
    }

    /**
     * $this->events is sorted in descening year_of order
     * The 'firstevent' is the most recent event
     * The 'lastevent' is the oldest event
     */
    public function firsteventclick()
    {
        $this->event = $this->lastevent;
        $this->selectoryear = $this->event->id;
        $this->current = ($this->events->count() - 1);
        $this->next = ($this->current - 1);
        $this->previous = $this->current;
    }

    public function lasteventclick()
    {
        $this->event = $this->firstevent;
        $this->selectoryear = $this->event->id;
        $this->current = $this->events->count();
        $this->next = ($this->current - 1);
        $this->previous = $this->current;
    }

    public function nexteventclick()
    {
        if(! ($this->event->id === $this->firstevent->id)) {
            $this->setEvent(1);
        }
    }

    public function previouseventclick()
    {
        if(! ($this->event->id === $this->lastevent->id)) {
            $this->setEvent(-1);
        }
    }

    public function updatedSelectoryear()
    {
        $this->event = $this->events->where('id', $this->selectoryear)->first();
    }

    private function setEvent($increment)
    {
        $this->event = $this->events->where('year_of', ($this->event->year_of + $increment))->first();
        $this->selectoryear = $this->event->id;
    }

}
