<?php

namespace App\Http\Livewire\Guest;

use App\Models\Conductor;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class ConductorComponent extends Component
{
    public $event;
    public $participants;

    public $length = 10;
    public $maxcount = 0;
    public $offset = 0;
    public $page = 0;

    public function mount()
    {
        $this->event = NULL;
        $this->participants = NULL;
    }

    public function render()
    {
        return view('livewire.guest.conductor-component',
            [
                'conductors' => $this->conductors()
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

    public function previousPage()
    {
        if($this->page){
            $this->page--;
            $this->offset = ($this->page * $this->length);
        }
    }

    public function setEvent($event_id)
    {
        $this->event = Event::find($event_id);
        $this->participants = Participant::where('event_id', $this->event->id)->get();
    }

    private function conductors()
    {
        $a = DB::select("
SELECT b.id AS event_id, b.year_of, c.name
FROM `conductor_event` a, events b, conductors c
WHERE a.event_id=b.id
  AND a.conductor_id=c.id
ORDER BY b.year_of DESC");
        $this->maxcount = count($a);

        return array_slice($a, $this->offset,$this->length);
    }
}
