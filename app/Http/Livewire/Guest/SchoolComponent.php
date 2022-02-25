<?php

namespace App\Http\Livewire\Guest;

use App\Models\Event;
use App\Models\Participant;
use App\Models\School;
use Livewire\Component;

class SchoolComponent extends Component
{
    public $event = null;
    public $eventschoolid = '0_0';

    public $school = null;
    public $schoolid = 0;
    public $search = '';

    public $length = 15;
    public $maxcount = 0;
    public $page = 0;

    public $offset = 0;

    public function render()
    {
        return view('livewire.guest.school-component',
            [
                'items' => $this->items(),
                'participants' => $this->event ? $this->participants() : collect(),
            ]
        );
    }

    public function nextPage()
    {
        $lastpage = floor($this->maxcount / $this->length);

        if($this->page != $lastpage){
            $this->page++;
            $this->offset = ($this->page * $this->length);
        }
    }

    private function items()
    {
        //early exit
        if(! strlen($this->search)){  return collect(); }

        $schools = School::where('name','LIKE', $this->search.'%')->orderBy('name')->get();

        if(! $schools){ return collect();};

        $this->maxcount = $schools->count();

        if(($this->page === 0) && ($schools->count() < $this->length)){

            return $schools;
        }else{

            return $schools->splice($this->offset, $this->length);
        }
    }

    public function previousPage()
    {
        if($this->page){
            $this->page--;
            $this->offset = ($this->page * $this->length);
        }
    }

    public function updatedEventschoolid()
    {
        //parts[0] = event->id, parts[1] = school->id
        $parts = explode('_', $this->eventschoolid);

        $this->event = Event::find($parts[0]);
        $this->schoolid = $parts[1];
        $this->school = School::find($this->schoolid);
    }

    public function updatedSearch()
    {
        $this->reset(['event', 'maxcount','offset','page']);
    }

    private function participants()
    {
        //early exit
        if(! $this->event){ return collect(); }

        return Participant::where('event_id', $this->event->id)->get();
    }

}
