<?php

namespace App\Http\Livewire\Guest;

use App\Models\Composition;
use App\Models\Event;
use App\Models\Participant;
use App\Models\School;
use Livewire\Component;

class TitleComponent extends Component
{
    public $event = null;
    public $eventcompositionid = '0_0';

    public $composition = null;
    public $compositionid = 0;
    public $search = '';

    public $sortperformed = null;

    public $length = 15;
    public $maxcount = 0;
    public $page = 0;

    public $offset = 0;

    public function render()
    {
        return view('livewire.guest.title-component',
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
        //default load
        if(is_null($this->sortperformed)) { //use default title sort

            $default = Composition::orderBy('title')->get();

        }elseif($this->sortperformed) { //request to sort by performed ascending order

            $default = Composition::all()->sortBy('performanceCount');

        }else { //request to sort by performed descending order

            $default =  Composition::all()->sortByDesc('performanceCount');
        }


        //early exit
        if(! strlen($this->search)) {
            $this->maxcount = $default->count();
            return $default->splice($this->offset, $this->length);
        }

        //user has added a search value
        $compositions = Composition::where('title','LIKE', '%'.$this->search.'%')->orderBy('title')->get();

        if(! $compositions){ return collect();};

        $this->maxcount = $compositions->count();

        if(($this->page === 0) && ($compositions->count() < $this->length)){

            return $compositions;
        }else{

            return $compositions->splice($this->offset, $this->length);
        }
    }

    public function previousPage()
    {
        if($this->page){
            $this->page--;
            $this->offset = ($this->page * $this->length);
        }
    }
/*
    public function sortByArtist()
    {
        $this->search = ''; //triggers updatedSearch();
        $this->sortperformed = (! $this->sortperformed);
    }
*/
    public function sortByPerformed()
    {
        $this->search = ''; //triggers updatedSearch();
        $this->sortperformed = (! $this->sortperformed);
    }

    public function sortByTitle()
    {
        $this->search = ''; //triggers updatedSearch();
        $this->sortperformed = null;
    }

    public function updatedEventcompositionid()
    {
        //parts[0] = event->id, parts[1] = school->id
        $parts = explode('_', $this->eventcompositionid);

        $this->event = Event::find($parts[0]);
        $this->compositionid = $parts[1];
        $this->composition = Composition::find($this->compositionid);
    }

    public function updatedSearch()
    {
        $this->reset(['event', 'maxcount','offset','page', 'sortperformed', ]);
    }

    private function participants()
    {
        //early exit
        if(! $this->event){ return collect(); }

        return Participant::where('event_id', $this->event->id)->get();
    }
}
