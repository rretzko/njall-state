<?php

namespace App\Http\Livewire\Selectors;

use App\Models\Event;
use Livewire\Component;

class YearsSelector extends Component
{
    public $current=0;
    public $event;
    public $events;
    public $next=0;
    public $previous=0;

    public function mount()
    {
        if(is_null($this->event)){
            $this->event = Event::getCurrentEvent();
        }

        $this->events = Event::orderByDesc('year_of')->get();

        $this->calcYears();
    }

    public function render()
    {
        return view('livewire.selectors.years-selector');
    }

    public function nextYear()
    {
        $this->event = Event::where('year_of', $this->next)->first();
        $this->calcYears();
    }

    public function previousYear()
    {
        $this->event = Event::where('year_of', $this->previous)->first();
        $this->calcYears();
    }

    private function calcYears()
    {
        $this->current = $this->event ? $this->event->year_of : $this->events->first()->year_of;
        $this->previous = ($this->current === $this->events->last()->year_of) ? $this->current : ($this->current - 1);
        $this->next = ($this->current === $this->events->first()->year_of) ? $this->current : ($this->current + 1);

        $this->emit('newevent', $this->current);
    }


}
