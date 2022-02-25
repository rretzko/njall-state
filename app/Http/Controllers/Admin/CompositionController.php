<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Composition;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CompositionController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('composition_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.composition.index');
    }

    public function create()
    {
        abort_if(Gate::denies('composition_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.composition.create');
    }

    public function edit(Composition $composition)
    {
        abort_if(Gate::denies('composition_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.composition.edit', compact('composition'));
    }

    public function show(Composition $composition)
    {
        abort_if(Gate::denies('composition_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.composition.show', compact('composition'));
    }
}
