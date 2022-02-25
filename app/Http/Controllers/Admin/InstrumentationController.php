<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Instrumentation;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class InstrumentationController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('instrumentation_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.instrumentation.index');
    }

    public function create()
    {
        abort_if(Gate::denies('instrumentation_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.instrumentation.create');
    }

    public function edit(Instrumentation $instrumentation)
    {
        abort_if(Gate::denies('instrumentation_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.instrumentation.edit', compact('instrumentation'));
    }

    public function show(Instrumentation $instrumentation)
    {
        abort_if(Gate::denies('instrumentation_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.instrumentation.show', compact('instrumentation'));
    }
}
