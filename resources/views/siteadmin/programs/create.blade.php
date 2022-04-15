@extends('layouts.sydney.guest')

@section('content')

    <div id="template-structure" class="flex" style="">

        <div class="flex flex-col">
            <div class="flex flex-col">
                @if(auth()->user())
                    <a href="{{ route('siteadmin.program') }}">Add Program</a>
                    <a href="">Add Participants</a>
                @endif
            </div>

            {{-- SIDEBAR --}}
            <div id="sidebar" class="flex flex-col px-2 py-2" style="background-color: rgba(0,0,0,.1);">
                <div id="global-select">
                    @livewire('templates.global-search', ['searchlist' => $searchlist ])
                </div>

            </div><!-- end of sidebar --></div>

        {{-- FORM --}}
        <style>
            ul{margin-left: 2rem;}
        </style>
        <div id="punchlist">
            <h5>Punchlist</h5>
            <ul>
                <li>Compositions
                <ul>
                    <li>Title</li>
                    <li>Subtitle</li>
                </ul></li>
                <li>Composition_Event
                <ul>
                    <li>event_id</li>
                    <li>composition_id</li>
                    <li>opener</li>
                    <li>closer</li>
                    <li>combined</li>
                    <li>order_by</li>
                </ul></li>
                <li>Artist
                <ul>
                    <li>first</li>
                    <li>last</li>
                </ul></li>
                <li>artist_artisttype
                    <ul>
                        <li>artist_id</li>
                        <li>artisttype_id</li>
                    </ul>
                </li>
                <li>artist_composition
                <ul>
                    <li>artist_id</li>
                    <li>composition_id</li>
                    <li>artisttype_id</li>
                </ul></li>
                <li>Conductors
                <ul>
                    <li>name</li>
                    <li>first</li>
                    <li>last</li>
                </ul></li>
                <li>conductor_event
                <ul>
                    <li>conductor_id</li>
                    <li>event_id</li>
                </ul></li>
            </ul>
        </div>
        <div>
            <label class="block text-sm font-medium text-gray-700"> Cover photo </label>
            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                    <svg class="mx-auto h-12 w-12 text-gray-400" stroke="currentColor" fill="none" viewBox="0 0 48 48" aria-hidden="true">
                        <path d="M28 8H12a4 4 0 00-4 4v20m32-12v8m0 0v8a4 4 0 01-4 4H12a4 4 0 01-4-4v-4m32-4l-3.172-3.172a4 4 0 00-5.656 0L28 28M8 32l9.172-9.172a4 4 0 015.656 0L28 28m0 0l4 4m4-24h8m-4-4v8m-12 4h.02" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <div class="flex text-sm text-gray-600">
                        <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                            <span>Upload a file</span>
                            <input id="file-upload" name="file-upload" type="file" class="sr-only">
                        </label>
                        <p class="pl-1">or drag and drop</p>
                    </div>
                    <p class="text-xs text-gray-500">PNG, JPG, GIF up to 10MB</p>
                </div>
            </div>
        </div>

    </div><!-- end of template-structure -->


@endsection
