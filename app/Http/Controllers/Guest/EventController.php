<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Event $event = NULL, Participant $participant = NULL)
    {
        return view('guests.templates.event',
        [
            'active' => 'programs',
            'event' => $event ?? Event::getCurrentEvent(),
            'events' => Event::orderByDesc('year_of')->get(),
            'participant' => $participant,
            'searchlist' => $event->year_of,
        ]);

    }
}
