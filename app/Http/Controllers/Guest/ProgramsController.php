<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class ProgramsController extends Controller
{
    public function index()
    {
        return redirect()->route('guest.event', ['active' => 'programs', 'event' => Event::getCurrentEvent()]);
    }
}
