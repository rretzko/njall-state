@extends('layouts.sydney.guest')

@section('content')

    <div id="template-structure" class="flex" style="">

        {{-- SIDEBAR --}}
        <div id="sidebar" class="flex flex-col px-2 py-2" style="background-color: rgba(0,0,0,.1);">
            <div id="global-select">
                @livewire('templates.global-search', ['searchlist' => $searchlist ])
            </div>

        </div><!-- end of sidebar -->

        {{-- MAIN CONTENT --}}
        <div class="px-4 sm:px-6 lg:px-8 ">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Schools: {{ $school->name }}</h1>
                </div>
            </div>
            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">

                            {{-- SEARCH --}}
                            <div class="my-2 ml-4 mb-6">

                                <form method="post" action="https://njall-state.com/schools/search" > {{-- action="{{ route('guest.schoolssearch') }}"> --}}

                                    @csrf

                                    <input type="text" name="search" id="search" value="" placeholder="School Name"
                                           style="border-radius: 1rem;"
                                    />
                                    <input type="submit" name="submit" id="submit" value="Search" class="px-2 rounded"/>
                                </form>
                            </div>

                            {{-- YEARS --}}
                            <style>
                                td,th{border: 1px solid black; padding: 0 0.25rem;}
                            </style>
                            <div class="flex flex-row flex-wrap">
                                {{-- SCHOOL YEARS TABLE --}}
                                <div class=" ml-4 mb-6">
                                    <table class="mr-6">
                                        <thead>
                                        <tr>
                                            <th>Year</th>
                                            <th>Conductor</th>
                                            <th>Students</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($events AS $event)
                                            <tr style="background-color: @if($loop->odd) rgba(0,0,0,.1) @else transparent @endif ">
                                                <td>{{ $event->year_of }}</td>
                                                <td>{{ $event->conductorsCsv }}</td>
                                                <td class="text-center">
                                                    <a style="color: blue;"
                                                       href="{{ route('guest.mystudents', [$school, $event]) }}"
                                                       title="Show {{ $event->name }} {{ $school->name }} students"
                                                    >
                                                        {{ $event->schoolParticipantCount($school) }}
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3" class="text-center">
                                                    No event found
                                                </td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>

                                {{-- SCHOOL PARTICIPANTS TABLE --}}
                                <div class="ml-4 mb-6">
                                    <table>
                                        <thead>
                                        <tr>
                                            <th>Year</th>
                                            <th>Name</th>
                                            <th>Voice Part</th>
                                            <th>Years</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @forelse($participants AS $participant)
                                            <tr style="background-color: @if($loop->odd) rgba(0,0,0,0.1) @else transparent @endif ">
                                                <td>{{ $participant->event->year_of }}</td>
                                                <td>{{ $participant->fullNameAlpha }}</td>
                                                <td class="text-center">{{ $participant->instrumentation->descr }}</td>
                                                <td class="text-center">{!! $participant->yearsCsv() !!}</td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="3">No students found</td>
                                            </tr>
                                        @endforelse
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div>



                            </div>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
