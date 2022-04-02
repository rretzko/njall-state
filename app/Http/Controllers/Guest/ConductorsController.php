<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Participant;
use Illuminate\Http\Request;

class ConductorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('guests.templates.event',
            [
                'active' => 'events',
                'event' => $event ?? Event::getCurrentEvent(),
                'events' => Event::orderByDesc('year_of')->get(),
                'participant' => NULL,
                'searchlist' => 'conductors',
            ]);

    }
}
