<?php

namespace App\Http\Livewire\Guest\Home;

use App\Models\Event;
use Livewire\Component;

class RecentEvents extends Component
{
    public $current;
    public $event;
    public $next;
    public $previous;

    public $maxyear;
    public $minyear;

    public function mount()
    {
        $this->event = Event::orderByDesc('year_of')->first();
        $this->maxyear = $this->event->year_of;
        $this->minyear = Event::orderBy('year_of')->first()->year_of;
        $this->calcYears();
    }
    public function render()
    {
        return view('livewire.guest.home.recent-events');
    }

    /**
     * Calc next year if NOT currently at $this->maxyear
     */
    public function nextYear()
    {
        if ($this->current !== $this->maxyear){
            $this->event = Event::where('year_of', ($this->current + 1))->first();
            $this->calcYears();
        }
    }

    public function previousYear()
    {
        if($this->current !== $this->minyear) {
            $this->event = Event::where('year_of', ($this->current - 1))->first();
            $this->calcYears();
        }
    }

    private function calcYears()
    {
        $this->current = $this->event->year_of;
        $this->previous = ($this->current === $this->minyear) ? $this->current : ($this->current - 1);
        $this->next = ($this->current === $this->maxyear) ? $this->current : ($this->current + 1);
    }
}
