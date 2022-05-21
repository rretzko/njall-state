<?php

namespace App\Http\Controllers\Siteadmin;

use App\Http\Controllers\Controller;
use App\Imports\ParticipantsImport;
use Illuminate\Http\Request;
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

    public function upload(Request $request)
    {
        Excel::import(new ParticipantsImport, $request->file('file-upload'));

        return $this->create();
    }
}
