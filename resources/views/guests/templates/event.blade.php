@extends('layouts.sydney.guest')

@section('content')

    <div id="template-structure" class="flex" style="">

        <div class="flex flex-col">
            <div class="flex flex-col">
                @if(auth()->user())
                    <a href="{{ route('siteadmin.program') }}">
                        Add Program
                    </a>
                    <a href="{{ route('siteadmin.participant') }}">
                        Add Participants
                    </a>
                @endif
            </div>

            {{-- SIDEBAR --}}
            <div id="sidebar" class="flex flex-col px-2 py-2" style="background-color: rgba(0,0,0,.1);">
                <div id="global-select">
                    @livewire('templates.global-search', ['searchlist' => $searchlist ])
                </div>

            </div><!-- end of sidebar --></div>

        {{-- CONTENT = CONDUCTOR + PROGRAM + PARTICIPANTS--}}
        <div id="request-content" class="flex flex-col w-full ml-1" style="background-color: transparent;">

            {{-- YEAR SELECTORS --}}
            <div id="year-selector" class="flex">
                <livewire:selectors.years-selector :event="$event" :events="$events" />
            </div>

            {{-- PROGRAM --}}
            <div id="program">
                <livewire:listeners.event-listener :event="$event"/>

            </div>

            {{-- PARTICIPANTS  --}}
            <div id="participants">
                <livewire:listeners.participants-listener :event="$event" :participant="$participant" />
            </div>

        </div><!-- end of request-content -->

    </div><!-- end of template-structure -->


@endsection
