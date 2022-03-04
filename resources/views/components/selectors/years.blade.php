@props([
    'events',
])
<div id="select-years" class="flex justify-center mt-8" >

    <div class="pt-3 mr-2">
        {{ $this->events->last()->year_of }}
    </div>

    {{-- Hericons double-chevron left --}}
    <div class="w-8 h-12 pt-3">

        <span wire:click="firsteventclick()" class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 19l-7-7 7-7m8 14l-7-7 7-7" />
            </svg>
        </span>

    </div>
    {{-- Hericons single-chevron left --}}
    <div class="w-8 h-12 pt-3 mr-6">

        <span wire:click="previouseventclick()" class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
            </svg>
        </span>

    </div>

    <select wire:model.debounce.1000ms="selectoryear" name="year_of" style="color: darkblue;" class="h-12" autofocus>
        @foreach($events AS $event)
            <option value="{{ $event->id }}">
                {{ $event->year_of }}
            </option>
        @endforeach
    </select>

    {{-- Hericons single-chevron right --}}
    <div class="w-8 h-12 pt-3 ml-6">

        <span wire:click="nexteventclick()" class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
            </svg>
        </span>

    </div>

    {{-- Hericons double-chevron right --}}
    <div class="w-8 h-12 pt-3">

        <span wire:click="lasteventclick()" class="cursor-pointer">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7"/>
            </svg>
        </span>
    </div>

    <div class="pt-3">
        {{ $this->events->first()->year_of }}
    </div>

</div>
