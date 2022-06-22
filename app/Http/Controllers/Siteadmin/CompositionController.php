<?php

namespace App\Http\Controllers\Siteadmin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use App\Models\Artisttype;
use App\Models\Composition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompositionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $by=false)
    {
        $compositions = Composition::orderBy('title')->get();

        if($by && ($by === 'count')){

            $compositions = $compositions->sortBy('performanceCount');
        }

        return view('siteadmin.compositions.edit',
            compact('compositions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Composition $composition
     * @return \Illuminate\Http\Response
     */
    public function edit(Composition $composition)
    {
        $compositions = Composition::orderBy('title')->get();
        $similars = Composition::where('title', 'like', $composition->title)
            ->where('id', '!=', $composition->id)
            ->get();

        return view('siteadmin.compositions.edit',
            compact('compositions','composition','similars'));
    }

    public function replace(Request $request, int $old, int $new)
    {
        DB::table('composition_event')
            ->where('composition_id', '=', $old)
            ->update(['composition_id' => $new]);

        //Delete old composition if no performance usage found (i.e. expected result)
        $test = Composition::find($old);

        if($test && (! $test->performanceCount)){

            $test->delete();
        }

        //set up for refreshed view
        $compositions = Composition::orderBy('title')->get();

        return view('siteadmin.compositions.edit',
            compact('compositions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Composition $composition
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Composition $composition)
    {
        $inputs = $this->validation($request);

        $composition->update(
            [
                'title' => $inputs['title'],
            ]
        );

        //$this->updateArrangers($composition, $inputs);
        $this->updateArtisttypes($composition, $inputs);

        //set up for refreshed view
        $compositions = Composition::orderBy('title')->get();

        return view('siteadmin.compositions.edit',
            compact('compositions'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Composition $composition
     * @return \Illuminate\Http\Response
     */
    public function destroy(Composition $composition)
    {
        $success = '"'.$composition->title.'" has been removed.';

        $composition->delete();

        return back()->with('success', $success);
    }

/** END OF PUBLIC FUNCTIONS **************************************************/

    /**
     * insert artist_composition rows
     * @param Composition $composition
     * @param Artist $artist
     * @param int $artisttype_id
     * @return void
     */
    private function artisttypeInsert(Composition $composition, Artist $artist, int $artisttype_id) : void
    {
        DB::table('artist_composition')
            ->insert(
                [
                    'composition_id' => $composition->id,
                    'artist_id' => $artist->id,
                    'artisttype_id' => $artisttype_id,
                ]
            );
    }

    /**
     * remove existing artist_composition rows
     * @param Composition $composition
     * @param int $artisttype_id
     * @return void
     */
    private function artisttypeRemove(Composition $composition, int $artisttype_id)
    {
        DB::table('artist_composition')
            ->where('composition_id', $composition->id)
            ->where('artisttype_id', $artisttype_id)
            ->delete();
    }

    private function updateArtist(int $artisttype_id, string $raw, Composition $composition)
    {
        //add new artist_composition row
        $parts = explode(' ', $raw);
        $last = array_pop($parts);
        $first = implode(' ',$parts);

        $artist = Artist::firstOrCreate(
            [
                'first' => $first,
                'last' => $last,
            ]);

        $this->artisttypeRemove($composition, $artisttype_id);
        $this->artisttypeInsert($composition, $artist, $artisttype_id);
    }

    private function updateArrangers(Composition $composition, array $inputs): void
    {
        if($composition->artisttypeString($composition->arrangers) == $inputs['arranger']) { //no change: early exit

            //do nothing

        }elseif(! strlen($inputs['arranger'])){ //arranger has been removed and not replaced

            $this->artisttypeRemove($composition, Artisttype::ARRANGER);

        }else{ //new arranger value has been entered

            $this->updateArtist(Artisttype::ARRANGER, $inputs['arranger'], $composition);
        }
    }

    private function updateArtisttypes(Composition $composition, array $inputs): void
    {
        $types = [
            'arranger' =>
                [
                    'singular' => 'arranger',
                    'plural' => 'arrangers'
                ],
            'composer' =>
                [
                    'singular' => 'composer',
                    'plural' => 'composers'
                ],
        ];

        foreach($types AS $type){
            $plural = $type['plural'];
            $singular = $type['singular'];
            $artisttype_id = Artisttype::where('descr', $singular)->first()->id;

            if($composition->artisttypeString($composition->{$plural}) == $inputs[$singular]) { //no change: early exit

                //do nothing

            }elseif(! strlen($inputs[$singular])){ //artist has been removed and not replaced

                $this->artisttypeRemove($composition, $artisttype_id);

            }else{ //new arranger value has been entered

                $this->updateArtist($artisttype_id, $inputs[$singular], $composition);
            }
        }

    }

    private function validation(Request $request)
    {
        return $request->validate(
            [
                'arranger' => ['string', 'nullable'],
                'composer' => ['string','nullable'],
                'title' => ['string','required'],
            ]
        );
    }


}
