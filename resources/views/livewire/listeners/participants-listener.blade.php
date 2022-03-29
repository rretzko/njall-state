<div class="text-center pb-4">

    @foreach($event->ensembles AS $ensemble)
        @if($ensemble->participantsCount($event))

            <header class="bg-blueGray-300 font-bold mb-2" >
                {{ $ensemble->name }} Participants ({{ $ensemble->participantsCount($event) }})
            </header>

            @forelse($ensemble->instrumentations AS $instrumentation)
                <div x-data="{ active: {{ $ensemble->instrumentations->first()->id }} }" class="space-y-4">
                    <div x-data="{
                    id: {{ $instrumentation->id }},
                    get expanded() { return this.active === this.id },
                    set expanded(value) { this.active = value ? this.id : null },
                    }"
                         role="region"
                         class="border border-black rounded-md shadow"
                    >
                        <h2>
                            <button
                                x-on:click="expanded = !expanded"
                                :aria-expanded="expanded"
                                class="flex items-center justify-between w-full font-bold text-xl px-6 py-3"
                            >
                                <span>{{ $instrumentation->descr }} ({{ $ensemble->participantsByInstrumentationCount($event, $instrumentation) }})</span>
                                <span x-show="expanded" aria-hidden="true" class="ml-4">&minus;</span>
                                <span x-show="!expanded" aria-hidden="true" class="ml-4">&plus;</span>
                            </button>
                        </h2>
                        <div x-show="expanded" x-collapse.duration.1500ms>
                            <div class="pb-4 px-6 flex flex-wrap">
                                {!! $ensemble->participantsByInstrumentationBlocks($event, $instrumentation,10) !!}
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div>No Participants found for {{$instrumentation->descr}}</div>
            @endforelse

        @endif
    @endforeach

</div>

