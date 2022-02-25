<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ParticipantController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('participant_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.participant.index');
    }

    public function create()
    {
        abort_if(Gate::denies('participant_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.participant.create');
    }

    public function edit(Participant $participant)
    {
        abort_if(Gate::denies('participant_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.participant.edit', compact('participant'));
    }

    public function show(Participant $participant)
    {
        abort_if(Gate::denies('participant_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $participant->load('instrumentation', 'school');

        return view('admin.participant.show', compact('participant'));
    }
}
