<?php

namespace App\Http\Controllers\Siteadmin;

use App\Http\Controllers\Controller;
use App\Models\Conductor;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $by_year=false)
    {
        $conductors = ($by_year)
            ? Conductor::orderBy('last')->orderBy('first')->get()->sortBy('years')
            : Conductor::orderBy('last')->orderBy('first')->get();

        return view('siteadmin.conductors.index',
            compact('conductors'));
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
        $inputs = $this->validation($request);

        $conductor = new Conductor;
        $conductor->name = $inputs['name'];
        $conductor->first = $conductor->getFirstAttribute();
        $conductor->last = $conductor->getLastAttribute();
        $conductor->save();

        return $this->index($request);
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
     * @param  \App\Models\Conductor $conductor
     * @return \Illuminate\Http\Response
     */
    public function edit(Conductor $conductor)
    {
        $conductors = Conductor::orderBy('last')->orderBy('first')->get();

        return view('siteadmin.conductors.edit',
            compact('conductors','conductor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Conductor $conductor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Conductor $conductor)
    {
        $inputs = $this->validation($request);

        $conductor->update($inputs);

        $conductor->first = $conductor->getFirstAttribute();
        $conductor->last = $conductor->getLastAttribute();
        $conductor->save();

        return $this->index($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Conductor $conductor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Conductor $conductor)
    {
        Conductor::destroy($conductor->id);

        return $this->index($request);
    }

    private function validation(Request $request)
    {
        return $request->validate(
            [
                'name' => ['string', 'required'],
            ]
        );
    }
}
