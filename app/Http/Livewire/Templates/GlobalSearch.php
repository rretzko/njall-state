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
        $this->searchresults = '<ul style="margin-top: 1rem; margin-left: 1rem;">';

        $this->searchresults .= $this->globalsearchParticipants();

        $this->searchresults .= $this->globalsearchYears();

        $this->searchresults .= '</ul>';
    }

    private function globalSearchParticipants()
    {
        $participants = $this->searchParticipants();

        $str = count($participants) ? '<li><b>Participants</b></li>' : '';

        foreach($participants AS $participant){

            $eventid = Event::where('year_of', $participant['eventyear'])->first()->id;

            $str .= '<li>'
                .'<a href="'.$eventid.'"'
                .' style="color: blue;" >'
                .$participant['fullnamealpha'].' ('.$participant['eventyear']
                .')</a>'
                . '</li>';
        };

        return $str;
    }

    private function globalSearchYears()
    {
        $years = $this->searchYears();

        $str = count($years) ? '<li><b>Years</b></li>' : '';

        foreach($years AS $year){

            $eventid = Event::where('year_of', $year)->first()->id;

            $str .= ($year == $this->globalsearch)
                ? '<li><b>'.$this->globalsearch.'</b></li>'
                :  '<li>'
                        .'<a href="'.$eventid.'"'
                        .' style="color: blue;" >'
                        .$year
                        .'</a>'
                    . '</li>';
        };

        return $str;
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

    private function searchYears() : array
    {
        //early exits
        if(! (strlen($this->globalsearch) === 4)){ return [];}
        if(! (int)$this->globalsearch){ return [];}

        $a = [];

        for($i=($this->globalsearch - 5); $i <= ($this->globalsearch + 5); $i++){

            $a[] = $i;
        }

        //listener: YearsSelector()
        $this->emit('sidebaryear', $this->globalsearch);

        return $a;
    }
}
