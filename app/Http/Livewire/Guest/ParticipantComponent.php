<?php

namespace App\Http\Livewire\Guest;

use App\Models\Event;
use App\Models\Participant;
use Livewire\Component;

class ParticipantComponent extends Component
{
    public $event = null;
    public $search = '';

    public $participantid = 0;

    public $length = 15;
    public $maxcount = 0;
    public $page = 0;

    public $offset = 0;

    public function render()
    {
        return view('livewire.guest.participant-component',
            [
                'items' => $this->items(),
                'participants' => $this->participants(),
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

        $participants = Participant::where('last','LIKE', $this->search.'%')->orderBy('last')->orderBy('first')->get();

        $this->maxcount = $participants->count();

        if(($this->page === 0) && ($participants->count() < $this->length)){

            return $participants;
        }else{

            return $participants->splice($this->offset, $this->length);
        }
    }

    public function previousPage()
    {
        if($this->page){
            $this->page--;
            $this->offset = ($this->page * $this->length);
        }
    }

    public function setEvent($eventid, $participantid)
    {
        $this->event = Event::find($eventid);
        $this->participantid = $participantid;
    }

    public function updatedSearch()
    {
        $this->reset(['event', 'maxcount','offset','page', 'participantid']);
    }

    private function participants()
    {
        //early exit
        if(! $this->event){ return collect(); }

        return Participant::where('event_id', $this->event->id)->get();
    }
}
