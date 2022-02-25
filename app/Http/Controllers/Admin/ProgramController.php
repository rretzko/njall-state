<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Program;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProgramController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('program_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.program.index');
    }

    public function create()
    {
        abort_if(Gate::denies('program_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.program.create');
    }

    public function edit(Program $program)
    {
        abort_if(Gate::denies('program_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.program.edit', compact('program'));
    }

    public function show(Program $program)
    {
        abort_if(Gate::denies('program_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $program->load('event');

        return view('admin.program.show', compact('program'));
    }
}
