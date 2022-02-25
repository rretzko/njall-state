<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Ensemble;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class EnsembleController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('ensemble_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ensemble.index');
    }

    public function create()
    {
        abort_if(Gate::denies('ensemble_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ensemble.create');
    }

    public function edit(Ensemble $ensemble)
    {
        abort_if(Gate::denies('ensemble_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ensemble.edit', compact('ensemble'));
    }

    public function show(Ensemble $ensemble)
    {
        abort_if(Gate::denies('ensemble_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.ensemble.show', compact('ensemble'));
    }
}
