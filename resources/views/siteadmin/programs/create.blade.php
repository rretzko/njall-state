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

            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                    <div class="flex text-sm text-gray-600">
                        <form method="post" action="{{ route('siteadmin.program.upload') }}"
                            enctype="multipart/form-data"
                            class="flex flex-col"
                            style="border: 1px solid black; padding: 0.5rem;"
                        >
                            @csrf

                            <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <span>Upload a CSV with program data</span>
                                <input id="file-upload" name="file-upload" type="file" class="sr-only">
                            </label>

                            <input type="submit" class="mt-2 w-1/4 px-2 mx-auto rounded text-black" name="submit" id="submit" value="Upload File" />
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- end of template-structure -->


@endsection
