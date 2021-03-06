<?php

namespace App\Http\Controllers\Siteadmin;

use App\Http\Controllers\Controller;
use App\Imports\CompositionsImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ProgramController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('siteadmin.programs.create',[
            'searchlist' => '',
        ]);
    }

    public function upload(Request $request)
    {
        Excel::import(new CompositionsImport, $request->file('file-upload'));

        return $this->create();
    }
}
