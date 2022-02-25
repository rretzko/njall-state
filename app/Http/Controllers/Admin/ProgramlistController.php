<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Programlist;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProgramlistController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('programlist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.programlist.index');
    }

    public function create()
    {
        abort_if(Gate::denies('programlist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.programlist.create');
    }

    public function edit(Programlist $programlist)
    {
        abort_if(Gate::denies('programlist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.programlist.edit', compact('programlist'));
    }

    public function show(Programlist $programlist)
    {
        abort_if(Gate::denies('programlist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $programlist->load('composition');

        return view('admin.programlist.show', compact('programlist'));
    }
}
