<?php

namespace App\Http\Livewire\Templates;

use App\Models\Composition;
use App\Models\Conductor;
use App\Models\Event;
use App\Models\Participant;
use App\Models\School;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class GlobalSearch extends Component
{
    public $searchlist=false;
    public $event;
    public $events;
    public $globalsearch='';
    public $participants=[];
    public $searchresults='';

    public function render()
    {
        return view('livewire.templates.globalsearch',
            [
                'alphaconductors' => $this->alphaConductors(),
                'alphaschools' => $this->alphaSchools(),
                'years' => $this->decadeSegment(),
            ]);
    }

    public function updatedGlobalsearch()
    {
        $this->searchresults = '<ul style="margin-top: 1rem; margin-left: 1rem;">';

        $this->searchresults .= $this->globalsearchConductors();

        $this->searchresults .= $this->globalsearchYears();

        $this->searchresults .= $this->globalsearchParticipants();

        $this->searchresults .= $this->globalsearchTitles();

        $this->searchresults .= '</ul>';

        $this->reset('globalsearch');
    }

    private function alphaConductors()
    {
        //early exit
        if(! ($this->searchlist === 'conductors')){ return '';}

        //reset value
        $this->reset('searchlist');

        $str = '<ul style="margin-left: 1rem;">';

        foreach(Conductor::orderBy('last')->get() AS $conductor){

            if($conductor->events->count()) {

                $str .= '<li>'
                    . '<a href="/guest/event/' . $conductor->events->first()->id . '" style="color: blue;">'
                    . $conductor->fullnameAlpha
                    . '</a>'
                    . '</li>';
            }else{

                Log::info('Missing events for conductor id: '.$conductor->id);
            }
        }

        $str .= '</ul>';

        return $str;
    }

    private function alphaSchools()
    {
        //early exit
        if(! ($this->searchlist === 'schools')){ return '';}

        //reset value
        $this->reset('searchlist');

        $str = '<ul style="margin-left: 1rem;">';

        foreach(School::orderBy('name')->get() AS $school){

            $str .= '<li>'
                . '<a href="/guest/event/'.$school->id.'" style="color: blue;">'
                .$school->name
                . '</a>'
                .'</li>';
        }

        $str .= '</ul>';

        return $str;
    }

    private function decadeSegment()
    {
        //return 10 year links based on current event
        if(! $this->globalsearch) {
            $event = Event::getCurrentEvent();
            $this->globalsearch = $event->year_of;
        }

        if(is_int($this->searchlist) && (strlen($this->searchlist) === 4)){

            $this->globalsearch = $this->searchlist;

            if(! $this->searchresults) {

                $this->updatedGlobalsearch();
            }else{

                $this->reset('globalsearch');
            }
        }
    }

    private function globalSearchConductors()
    {
        $conductors = $this->searchConductors();

        //display label if participants are found
        $str = count($conductors) ? '<li><b>Conductors</b></li>' : '';

        foreach($conductors AS $conductor){

            $eventid = Event::where('year_of', $conductor['eventyear'])->first()->id;

            $str .= '<li>'
                .'<a href="/guest/event/'.$eventid.'"'
                .' style="color: blue;" >'
                .$conductor['fullnamealpha'].' ('.$conductor['eventyear']
                .')</a>'
                . '</li>';
        };

        return $str;
    }

    private function globalSearchParticipants()
    {
        $participants = $this->searchParticipants();

        //display label if participants are found
        $str = count($participants) ? '<li><b>Participants</b></li>' : '';

        foreach($participants AS $participant){

            $eventid = Event::where('year_of', $participant['eventyear'])->first()->id;

            $str .= '<li>'
                .'<a href="/guest/event/'.$eventid.'/'.$participant['id'].'"'
                .' style="color: blue;" >'
                .$participant['fullnamealpha'].' ('.$participant['eventyear']
                .')</a>'
                . '</li>';
        };

        return $str;
    }

    private function globalSearchYears()
    {
        $years = $this->searchYears(); //ex. 11 row ul with the current search year in the middle

        $str = count($years) ? '<li><b>Years</b></li>' : '';

        foreach($years AS $year){

            if(Event::where('year_of', $year)->exists()) {

                $eventid = Event::where('year_of', $year)->first()->id;

                $str .= ($year == $this->globalsearch)
                    ? '<li><b>' . $this->globalsearch . '</b></li>' //current year === no anchor tag
                    : '<li>'
                    . '<a href="' . $eventid . '"'
                    . ' style="color: blue;" >'
                    . $year
                    . '</a>'
                    . '</li>';
            }
        };

        return $str;
    }

    private function globalSearchTitles()
    {
        $titles = $this->searchTitles();

        //display label if participants are found
        $str = count($titles) ? '<li><b>Titles</b></li>' : '';

        foreach($titles AS $title) {

            $str .= '<li>'
                . $title['title'] . '(' . $title['years'] . ')</li>';
        }

        return $str;
    }

    private function searchConductors() : array
    {
        //early exit
        if(! strlen($this->globalsearch)){ return [];}

        $a = [];

        foreach(Conductor::where('last', 'LIKE', '%'.$this->globalsearch.'%')
                    ->get() AS $conductor) {

           $a[] = [
               'sortby' => $conductor->fullnameAlpha.$conductor->events->first()->year_of,
                'id' => $conductor->id,
                'fullnamealpha' => $conductor->fullnameAlpha,
                'eventyear' => $conductor->events->first()->year_of
           ];
        }

        sort($a);

        return $a;
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

    private function searchTitles() : array
    {
        //early exit
        if(! strlen($this->globalsearch)){ return [];}

        $a = [];

        foreach(Composition::where('title', 'LIKE', '%'.$this->globalsearch.'%')
                    ->get() AS $composition) {

            $a[] = [
                'sortby' => $composition->title.$composition->yearsCsv,
                'id' => $composition->id,
                'title' => $composition->title,
                'years' => $composition->performanceYearsCsv
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
