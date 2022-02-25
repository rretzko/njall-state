<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Artist;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ArtistController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('artist_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.artist.index');
    }

    public function create()
    {
        abort_if(Gate::denies('artist_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.artist.create');
    }

    public function edit(Artist $artist)
    {
        abort_if(Gate::denies('artist_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.artist.edit', compact('artist'));
    }

    public function show(Artist $artist)
    {
        abort_if(Gate::denies('artist_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $artist->load('artisttype');

        return view('admin.artist.show', compact('artist'));
    }
}
