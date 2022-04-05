<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\School;
use App\Services\SchoolSortService;
use Illuminate\Http\Request;

class SchoolsController extends Controller
{
    private $schoolsortservice;

    public function __construct(SchoolSortService $schoolsortservice)
    {
        $this->schoolsortservice = $schoolsortservice;
    }

    public function index(Request $request)
    {
        $namedirection = (($request->input('column') === 'name') && ($request->input('direction') === 'asc'))
            ? 'desc'
            : 'asc';

        return view('guests.schools.index',
            [
                'active' => 'events',
                'column' => $request->input('column') ?? 'name',
                'page' => $request->input('page') ?? 1,
                'direction' => $request->input('direction') === 'asc' ? 'desc' : 'asc',
                'event' => $event ?? Event::getCurrentEvent(),
                'events' => Event::orderByDesc('year_of')->get(),
                'namedirection' => $namedirection,
                'participant' => NULL,
                'pointerdirection' => $request->input('direction'),
                'searchlist' => 'false',
                'schools' => $this->schoolsortservice->sort(),
            ]);
    }
}
