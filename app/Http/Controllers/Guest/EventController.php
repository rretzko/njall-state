<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Event $event = NULL)
    {
        return view('guests.templates.event',
        [
            'active' => 'events',
            'event' => $event ?? Event::getCurrentEvent(),
            'events' => Event::orderByDesc('year_of')->get(),
        ]);

    }
}
