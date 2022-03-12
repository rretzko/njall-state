<div style="background-color: rgba(4,54,101,0.66); color: white; margin: 0 10%;">

    <header style="font-size: 1.30rem; font-weight: bold; margin: 0.5rem 0;">Our Recent Chorus Programs</header>

    {{-- YEAR SELECTORS --}}
    <div id="selectors" class="" style="display: flex; justify-content: space-around; width: 40%; margin: auto; margin-bottom: 1rem;">
        <div wire:click="previousYear" id="previous" style="padding: 0.4rem 0; cursor:pointer; display: flex; vertical-align: center;">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" style="padding-top: 0.2rem;">
                <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
            </svg>
            {{ $this->previous }}
        </div>
        <div id="current" style="font-size: 1.5rem;">{{ $this->current }}</div>
        <div wire:click="nextYear" id="next" style="padding: 0.4rem 0; cursor: pointer; display: flex;">
            {{ $this->next }}
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" >
                <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
            </svg>
        </div>
    </div>

    {{-- PROGRAM CARDS --}}
    <div id="program-cards" style="display: flex;  margin: 0 10%; margin-bottom: 1rem;">
        <div id="conductor-card" style="width: 33%; border-right: 1px solid darkgrey; text-align: left; padding: 0 .5rem;">
            <header style="font-weight: bold; margin: 0.5rem 0;">
                {{ $this->event->name }}
            </header>
            <div>
                @forelse($this->event->conductors AS $conductor)
                    {{ $conductor->name }}<br />
                @empty
                    No conductor found
                @endforelse
            </div>
            <div style="font-size: .75rem;">
                Conductor
            </div>
            <div style="margin: 0.5rem 0;">
                <a href="{{ $this->event->program_link }}" @if(! $this->event->program_link) disabled @endif target="_NEW">
                    <button style="border-radius: 1rem; padding:0 1rem; cursor: pointer;"
                            @if(! $this->event->program_link) disabled @endif
                    >
                        Program PDF
                    </button>
                </a>
            </div>
        </div>
        <div id="program-card" style="width: 66%; text-align: left; padding: 0 .5rem;">
            <header style="font-weight: bold; margin: 0.5rem 0;">
                Program
            </header>
            <div>
                @forelse($this->event->compositions AS $composition)
                    <div style="display: flex; flex-direction: column;">
                        <div style="display: flex; flex-direction: row;">
                            <div style="width: 60%;" title="{{ $composition->title }}">
                                {{ trim(substr($composition->title, 0, 30)) }}@if(strlen($composition->title) > 30)... @endif
                            </div>
                            <div style="width: 38%; font-size: 1rem; margin-left: 1rem;">
                                @foreach($composition->composers AS $composer)
                                    <i>{{ $composer->fullname }}</i>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @empty
                    <div>No program found</div>
                @endforelse
            </div>
            <div style="margin: 0.5rem 0;">
                <a href="{{ $this->event->program_link }}" @if(! $this->event->compositions->count()) disabled @endif target="_NEW">
                    <button style="border-radius: 1rem; padding:0 1rem; cursor: pointer;"
                            @if(! $this->event->compositions->count()) disabled @endif
                    >
                        Program Detail
                    </button>
                </a>
            </div>
        </div>
    </div>
</div>
