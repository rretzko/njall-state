@extends('layouts.sydney.guest')

@section('content')

    <div id="template-structure" class="flex" style="">

        {{-- SIDEBAR --}}
        <div id="sidebar" class="flex flex-col px-2 py-2" style="background-color: rgba(0,0,0,.1);">
            <div id="global-select">
                @livewire('templates.global-search', ['searchlist' => $searchlist ])
            </div>

        </div><!-- end of sidebar -->

        <!-- This example requires Tailwind CSS v2.0+ -->
        <div class="px-4 sm:px-6 lg:px-8 ">
            <div class="sm:flex sm:items-center">
                <div class="sm:flex-auto">
                    <h1 class="text-xl font-semibold text-gray-900">Schools</h1>
                </div>
            </div>
            <div class="mt-8 flex flex-col">
                <div class="-my-2 -mx-4 overflow-x-auto sm:-mx-6 lg:-mx-8">
                    <div class="inline-block min-w-full py-2 align-middle md:px-6 lg:px-8">
                        <div class="overflow-hidden shadow ring-1 ring-black ring-opacity-5 md:rounded-lg">

                            {{-- SEARCH --}}
                            <div class="my-2">

                                <form method="post" action="{{ route('guest.schoolssearch') }}">

                                    @csrf

                                    <input type="text" name="search" id="search" value="" placeholder="School Name"
                                          style="border-radius: 1rem;"
                                    />
                                    <input type="submit" name="submit" id="submit" value="Search" class="px-2 rounded"/>
                                </form>
                            </div>

                            <table class="divide-y divide-gray-300" style="min-width: 32rem; width: 32rem;">
                                <caption>{{ $schoolstotalcount }} schools found.</caption>
                                <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="py-3.5 pl-4 pr-3 text-left text-sm font-semibold sm:pl-6" style="width: 70%;">
                                        <a href="{{ route('guest.schools', ['column' => 'name', 'direction' => $namedirection]) }}"
                                           class="group inline-flex"
                                           style="@if($column === 'name') color: blue @else color: black @endif"
                                        >
                                            Name
                                            <!-- Active: "bg-gray-200 text-gray-900 group-hover:bg-gray-300", Not Active: "invisible text-gray-400 group-hover:visible group-focus:visible" -->
                                            <span class="ml-2 flex-none rounded group-hover:visible group-focus:visible"
                                                style="@if($column === 'name') color: blue; @else color: black @endif">
                      <!-- Heroicon name: solid/chevron-down -->
                    @if(($column === 'name') && ($direction === 'asc'))
                        <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    @else
                        <!-- Heroicon name: solid chevron-down -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                    @endif
                    </span>
                                        </a>
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold " style="width: 15%;">
                                        <a href="{{ route('guest.schools', ['column' => 'years', 'direction' => $yearsdirection])  }}"
                                           class="group inline-flex"
                                           style="@if($column === 'years') color: blue @else color: black @endif"
                                        >
                                            Years
                                            <!-- Active: "bg-gray-200 text-gray-900 group-hover:bg-gray-300", Not Active: "invisible text-gray-400 group-hover:visible group-focus:visible" -->
                                            <span class="ml-2 flex-none rounded bg-gray-200 group-hover:bg-gray-300"
                                                style="@if($column === 'years') color: blue @else color: black @endif">
                       <!-- Heroicon name: solid/chevron-down -->
                    @if(($column === 'years') && ($direction === 'asc'))
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                                                @else
                                                <!-- Heroicon name: solid chevron-down -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                                                @endif
                    </span>
                                        </a>
                                    </th>
                                    <th scope="col" class="px-3 py-3.5 text-left text-sm font-semibold " style="width: 15%;">
                                        <a href="{{ route('guest.schools', ['column' => 'students', 'direction' => $studentsdirection])  }}"
                                           class="group inline-flex"
                                           style="@if($column === 'students') color: blue @else color: black @endif"
                                        >
                                            Students
                                            <!-- Active: "bg-gray-200 text-gray-900 group-hover:bg-gray-300", Not Active: "invisible text-gray-400 group-hover:visible group-focus:visible" -->
                                            <span class="ml-2 flex-none rounded bg-gray-200 group-hover:bg-gray-300"
                                                  style="@if($column === 'students') color: blue @else color: black @endif">
                       <!-- Heroicon name: solid/chevron-down -->
                    @if(($column === 'students') && ($direction === 'asc'))
                                                    <svg class="h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                                                @else
                                                <!-- Heroicon name: solid chevron-down -->
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                          <path fill-rule="evenodd" d="M14.707 12.707a1 1 0 01-1.414 0L10 9.414l-3.293 3.293a1 1 0 01-1.414-1.414l4-4a1 1 0 011.414 0l4 4a1 1 0 010 1.414z" clip-rule="evenodd" />
                        </svg>
                                                @endif
                    </span>
                                        </a>
                                    </th>
                                </tr>

                                <tbody class="divide-y divide-gray-200 bg-white">
                                    @foreach($schools AS $school)

                                        <tr style="{{ $loop->odd ? 'background-color: rgba(0,0,0,0.1)' : '' }}">
                                            <td class="whitespace-nowrap py-2 pl-4 pr-3 text-sm font-medium text-gray-900 sm:pl-6">
                                                <a href="{{ route('guest.school', $school) }}" style="color: blue;">
                                                    {{ $school->name }}
                                                </a>
                                            </td>
                                            <td class="whitespace-nowrap px-3 py-2 text-sm text-center">{{ $school->yearsCount }}</td>
                                            <td class="whitespace-nowrap px-3 py-2 text-sm text-center">{{ $school->studentsCount }}</td>
                                        </tr>                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>

                            <div class="flex justify-between px-4">
                                <div>
                                    <a href="{{ route('guest.schools',['column' => $column,'direction' => $pointerdirection, 'page' => ($page - 1)]) }}">
                                        <button class="rounded-full px-2" style="background-color: rgba(0,0,0,0.2);">
                                            &larr; Prev
                                        </button>
                                    </a>
                                </div>
                                <div class="mb-2">
                                    <a href="{{ route('guest.schools',['column' => $column,'direction' => $pointerdirection, 'page' => ($page + 1)]) }}">
                                        <button class="rounded-full px-2" style="background-color: rgba(0,0,0,0.2);">
                                            Next &rarr;
                                        </button>
                                    </a>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
