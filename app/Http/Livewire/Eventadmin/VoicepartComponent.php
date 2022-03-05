<?php

namespace App\Http\Livewire\Eventadmin;

use App\Models\Event;
use App\Models\Instrumentation;
use App\Models\Participant;
use Livewire\Component;

class VoicepartComponent extends Component
{
    public $eventid=0;
    public $instrumentationid=0;
    public $participants;
    public $switches=[];
    public $switchto=0;

    public function mount()
    {
        $this->participants = collect();
    }

    public function render()
    {
        return view('livewire.eventadmin.voicepart-component',
            [
                'events' => Event::orderByDesc('year_of')->get(),
                'instrumentations' => Instrumentation::orderBy('descr')->get(),
            ]);
    }

    public function switchInstrumentation()
    {
        foreach($this->switches AS $participantid){

            $participant = Participant::find($participantid);
            $participant->update([
                'instrumentation_id' => $this->switchto,
            ]);
        }

        $this->reset('switches','switchto');

        $this->setParticipants();
    }

    public function updatedEventid()
    {
        if($this->instrumentationid){

            $this->setParticipants();
        }
    }

    public function updatedInstrumentationid()
    {
        if($this->eventid){

            $this->setParticipants();
        }
    }

    public function setParticipants()
    {
        $this->participants = Participant::where('event_id', $this->eventid)
            ->where('instrumentation_id', $this->instrumentationid)
            ->get()
            ->sortBy('fullnameAlpha');
    }
}
