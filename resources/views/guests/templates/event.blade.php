@extends('layouts.sydney.guest')

@section('content')

    <div id="template-structure" class="flex" style="">

        <div id="sidebar" class="flex flex-col px-2 py-2" style="background-color: rgba(0,0,0,.1);">
            <div id="global-select">
                <livewire:templates.global-search />
            </div>
            <div id="accordion select">
                <livewire:templates.sidebar-filter />
                Accordion select
            </div>
        </div><!-- end of sidebar -->

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
                <livewire:templates.participants-component :event="$event" />
            </div>

        </div><!-- end of request-content -->

    </div><!-- end of template-structure -->


@endsection
