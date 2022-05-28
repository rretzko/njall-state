<?php

namespace App\Http\Controllers\Siteadmin;

use App\Http\Controllers\Controller;
use App\Imports\ParticipantsImport;
use App\Models\Event;
use App\Models\Instrumentation;
use App\Models\Participant;
use App\Models\School;
use App\Services\ParticipantFilterService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Maatwebsite\Excel\Facades\Excel;

class ParticipantController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siteadmin.participants.create',[
            'searchlist' => '',
        ]);
    }

    public function edit()
    {
        $participants = collect();

        return view('siteadmin.participants.edit', compact('participants'));
    }

    public function editform(Participant $participant)
    {
        $service = new ParticipantFilterService(
            [
                'first' => $participant->first,
                'last' => $participant->last,
                'year' => '',
            ]
        );
        $participants = $service->find();

        $events = Event::orderBy('year_of')->get();

        $instrumentations = Instrumentation::orderBy('descr')->get();

        $schools = School::orderBy('name')->get();

        return view('siteadmin.participants.edit',
            compact('events', 'instrumentations', 'participant','participants','schools')
        );
    }

    public function show(Request $request)
    {
        $service = new ParticipantFilterService($request->all());
        $participants = $service->find();

        return view('siteadmin.participants.edit', compact('participants'));
    }

    public function update(Request $request, Participant $participant)
    {
        $inputs = $request->validate(
            [
                'first' => ['string', 'required'],
                'last' => ['string', 'required'],
                'event_id' => ['numeric', 'required', 'exists:events,id'],
                'school_id' => ['numeric', 'required', 'exists:schools,id'],
                'instrumentation_id' => ['numeric', 'required', 'exists:instrumentations,id'],
            ]
        );

        $participant->update($inputs);

        $mssg = $participant->getFullnameAttribute().' ('.$participant->event->year_of.') has been updated.';

        return redirect('participant/edit')->with('success', $mssg);


    }

    public function upload(Request $request)
    {
        Excel::import(new ParticipantsImport, $request->file('file-upload'));

        return $this->create();
    }

    public function destroy(Participant $participant)
    {
        $mssg = $participant->getFullnameAttribute().' ('.$participant->event->year_of.') has been removed.';

        Participant::destroy($participant->id);

        return redirect('participant/edit')->with('success', $mssg);
    }


}
