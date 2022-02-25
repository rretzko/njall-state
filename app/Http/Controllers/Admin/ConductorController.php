<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Conductor;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ConductorController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('conductor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.conductor.index');
    }

    public function create()
    {
        abort_if(Gate::denies('conductor_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.conductor.create');
    }

    public function edit(Conductor $conductor)
    {
        abort_if(Gate::denies('conductor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.conductor.edit', compact('conductor'));
    }

    public function show(Conductor $conductor)
    {
        abort_if(Gate::denies('conductor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.conductor.show', compact('conductor'));
    }
}
