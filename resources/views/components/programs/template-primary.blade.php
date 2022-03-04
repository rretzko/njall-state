@props([
    'event',
    'participants',
    'compositionid' => 0,
    'participantid' => 0,
    'schoolid' => 0,
])

<div id="program" class="my-2 mx-auto">
    <section id="program-header" class="text-center mt-4 text-xl font-italic " style="color: yellow;">
        <div>{{ $event->name }}</div>
        <div>
            @forelse($event->conductors AS $conductor)
                <div>{{ $conductor->name }}</div>
            @empty
                <div>No conductor found</div>
            @endforelse
        </div>
        <div class="mb-2">
            @if(! is_null($event->program_link))
                <a href="{{ $event->program_link }}"
                   target="_BLANK"
                   class="text-sm"
                >
                    Click for: Image of program courtesy of HighSchoolChoralResources.com
                </a>
            @endif
        </div>
    </section>

    {{-- AUDIO --}}
    <audio id="player" src=""  ></audio>
    <script>
        function playthis($file){
            var $player = document.getElementById('player');
            $player.src = $file;
            console.log($file);
            $player.play();
        }
    </script>

    {{-- PROGRAM SELECTIONS --}}
    <section id="program" class="mt-2 text-center border border-white" style="margin: auto;">
        <header style="background-color: rgba(0,0,0,.1)" class="my-2 text-white text-lg font-bold uppercase">Program</header>
        @forelse($event->compositions AS $composition)
            <x-programs.composition-detail :composition="$composition" :event="$event" compositionid="{{$compositionid}}" iteration="{{ $loop->iteration }}"/>
        @empty
            No compositions found for {{ $event->name }}.
        @endforelse
    </section>

    <section id="participants" class="mt-4 border border-white text-center">

        <header style="background-color: rgba(0,0,0,.1)" class="my-2 text-white text-lg font-bold uppercase">Participants</header>

        @foreach($event->ensembles AS $ensemble)
            {{-- ONLY DISPLAY MIXED CHORUS INFORMATION --}}
            @if($ensemble->id === 1)
                <div class="ensemble-container mb-6">

                    <header class="uppercase mb-1">
                        {{ $ensemble->name }}
                        <span class="text-sm">({{ $participants->count() }} participants)</span>
                    </header>

                    <div id="participants-container" class="flex flex-wrap justify-center">
                        @foreach($ensemble->instrumentations AS $instrumentation)
                            <div class="border border-white" style="{{ ($loop->iteration % 2) ?: 'background-color: rgba(255,255,255,.1);' }}">

                                <header class="font-bold uppercase border-b-white px-2">{{ $instrumentation->descr }} ({{ $participants->where('ensemble_id', $ensemble->id)->where('instrumentation_id', $instrumentation->id)->count() }})</header>

                                @foreach($participants->where('ensemble_id', $ensemble->id)->where('instrumentation_id', $instrumentation->id) AS $participant)

                                    <div class="px-2"
                                         style="@if(($participant->school->id == $schoolid) || ($participant->id == $participantid)) color: gold; @endif"
                                         title="{{ $participant->school->name }}">
                                        {{ $participant->first.' '.$participant->last }}
                                    </div>
                                @endforeach

                            </div>
                        @endforeach

                    </div>
                </div>
            @endif
        @endforeach

    </section>
</div>

