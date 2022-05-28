<?php

namespace App\Services;


use App\Models\Participant;
use Illuminate\Database\Eloquent\Collection;

class ParticipantFilterService
{
    private $eventid;
    private $first;
    private $last;
    private $participants;
    private $year;

    public function __construct(array $filters)
    {
        $this->first = '%'.$filters['first'].'%';
        $this->last = '%'.$filters['last'].'%';
        $this->year = (is_numeric($filters['year']) && (strlen($filters['year']) === 4))
            ? $filters['year']
            : 0;

        $this->eventid = ($this->year) ? \App\Models\Event::where('year_of', $this->year)->first()->id : 0;

        $this->participants = $this->participants();
    }

    public function find() : Collection
    {
        return $this->participants;
    }

/** END OF PUBLIC FUNCTIONS **************************************************/

    private function participants()
    {
        //do filtered search if a value has been entered for first or last name
        if((strlen($this->first) > 2) || (strlen($this->last) > 2) || $this->eventid) {

            return Participant::where('first', 'like', $this->first)
                ->where('last', 'like', $this->last)
                ->where('event_id', ($this->eventid ? '=' : '>'), $this->eventid)
                ->orderBy('last')
                ->orderBy('first')
                ->orderBy('event_id')
                ->get();

        }else{ //pull all participants

            return Participant::all();
        }

    }
}
