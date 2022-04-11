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
        if(isset($request['column']) && isset($request['direction'])){
            if(($request['column'] === 'titles') && ($request['direction'] === 'desc')){
                $compositions = Composition::orderByDesc('title')->with('artists')->paginate(15);
            }else{
                $compositions = Composition::orderBy('title')->with('artists')->paginate(15);
            }
        }else{
            $compositions = Composition::orderBy('title')->with('artists')->paginate(15);
        }

        if((! isset($request['direction'])) || (isset($request['column']) && ($request['column'] === 'titles') && ($request['direction'] === 'desc'))){
            $titledirection = 'asc';
        }else{
            $titledirection = 'desc';
        }


//$first = $compositions->first();
//dd($first->events->first());
        return view('guests.titles.index',
            [
                'active' => 'events',
                'column' => $request->input('column') ?? 'title',
                'page' =>  $request->input('page') ?? 1,
                'direction' =>  $request->input('direction') === 'asc' ? 'desc' : 'asc',
                'event' => Event::getCurrentEvent(),//$event ??
                'events' => Event::orderByDesc('year_of')->get(),
                'titledirection' => $titledirection,
                'pointerdirection' => $request->input('direction') ?? 'asc',
                'searchlist' => 'false',
                'compositions' => $this->compositionsortservice->sort(),
                'compositionstotalcount' => Composition::all()->count(),
                'performeddirection' => 'asc',
            ]
        );
    }
}
