<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artisttype;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArtisttypeController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('artisttype_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.artisttype.index');
    }

    public function create()
    {
        abort_if(Gate::denies('artisttype_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.artisttype.create');
    }

    public function edit(Artisttype $artisttype)
    {
        abort_if(Gate::denies('artisttype_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.artisttype.edit', compact('artisttype'));
    }

    public function show(Artisttype $artisttype)
    {
        abort_if(Gate::denies('artisttype_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.artisttype.show', compact('artisttype'));
    }
}
