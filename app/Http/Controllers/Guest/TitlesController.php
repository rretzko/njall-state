<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Composition;
use App\Models\Event;
use App\Services\CompositionSortService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TitlesController extends Controller
{
    private $compositionsortservice;

    public function __construct(CompositionSortService $compositionsortservice)
    {
        $this->compositionsortservice = $compositionsortservice;
    }

    public function index(Request $request)
    {
        if((! isset($request['direction'])) ||
            (isset($request['column']) && ($request['column'] === 'titles') && ($request['direction'] === 'desc'))){

            $titledirection = 'asc';
        }else{
            $titledirection = 'desc';
        }

        if((! isset($request['direction'])) ||
            (isset($request['column']) && ($request['column'] === 'performed') && ($request['direction'] === 'desc'))){

            $performeddirection = 'asc';
        }else{
            $performeddirection = 'desc';
        }

        return view('guests.titles.index',
            [
                'active' => 'events',
                'column' => $request->input('column') ?? 'title',
                'page' =>  $request->input('page') ?? 1,
                'direction' =>  $request->input('direction') === 'asc' ? 'desc' : 'asc',
                'event' => Event::getCurrentEvent(),//$event ??
                'events' => Event::orderByDesc('year_of')->get(),
                'maxpage' => $this->compositionsortservice->maxPage(),
                'performeddirection' => $performeddirection,
                'pointerdirection' => $request->input('direction') ?? 'asc',
                'searchlist' => isset($request['search']) ? $request['search'] : null,
                'titledirection' => $titledirection,
                'compositions' => $this->compositionsortservice->sort(),
                'compositionstotalcount' => Composition::all()->count(),
            ]
        );
    }

    public function show(Request $request)
    {
        $compositions = $this->compositionsortservice->sort();

        return view('guests.titles.index',
            [
                'active' => 'events',
                'column' => $request->input('column') ?? 'title',
                'page' =>  $request->input('page') ?? 1,
                'direction' =>  $request->input('direction') === 'asc' ? 'desc' : 'asc',
                'event' => Event::getCurrentEvent(),//$event ??
                'events' => Event::orderByDesc('year_of')->get(),
                'maxpage' => $this->compositionsortservice->maxPage(),
                'performeddirection' => 'asc',
                'pointerdirection' => 'asc',
                'searchlist' => isset($request['search']) ? $request['search'] : '',
                'titledirection' => 'asc',
                'compositions' => $compositions,
                'compositionstotalcount' => $this->compositionsortservice->totalCount(),
            ]);
    }
}
