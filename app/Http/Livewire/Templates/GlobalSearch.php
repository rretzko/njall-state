<?php

namespace App\Http\Livewire\Templates;

use App\Models\Event;
use App\Models\Participant;
use Livewire\Component;

class GlobalSearch extends Component
{
    public $event;
    public $events;
    public $globalsearch='';
    public $participants=[];
    public $searchresults='';

    public function render()
    {
        return view('livewire.templates.globalsearch');
    }

    public function updatedGlobalsearch()
    {
        $this->searchresults = '<ul>';

        foreach($this->searchParticipants() AS $participant){

            $this->searchresults .= '<li>'
                .'<a href="participant/'.$participant['id'].'"'
                .' style="color: blue;" >'
                .$participant['fullnamealpha'].' ('.$participant['eventyear']
                .')</a>'
                . '</li>';
        };

        $this->searchresults .= '</ul>';
    }

    private function searchParticipants() : array
    {
        //early exit
        if(! strlen($this->globalsearch)){ return [];}

        $a = [];
        foreach(Participant::where('last', 'LIKE', '%'.$this->globalsearch.'%')
                    ->get() AS $participant) {

           $a[] = [
               'sortby' => $participant->fullnameAlpha.$participant->event->year_of,
                'id' => $participant->id,
                'fullnamealpha' => $participant->fullnameAlpha,
                'eventyear' => $participant->event->year_of
           ];
        }

        sort($a);

        return $a;
    }
}
