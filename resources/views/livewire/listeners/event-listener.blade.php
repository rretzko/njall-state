<div id="program">
    <div id="summary-program">
        <div id="program-cards" style="display: flex;  margin: 0 10%; margin-bottom: 1rem;">
            <div id="conductor-card" style="width: 33%; border-right: 1px solid darkgrey; text-align: left; padding: 0 .5rem;">
                <header style="font-weight: bold; margin: 0.5rem 0;">
                    {{ $event->name }}
                </header>
                <div>
                    @forelse($event->conductors AS $conductor)
                        {{ $conductor->name }}<br />
                    @empty
                        No conductor found
                    @endforelse
                </div>
                <div style="font-size: .75rem;">
                    Conductor
                </div>
                <div style="margin: 0.5rem 0;">
                    <a href="{{ $event->program_link }}" @if(! $event->program_link) disabled @endif target="_NEW" style="text-align: left;">
                        <button style="border-radius: 1rem; cursor: pointer; color: blue; font-size: 0.8rem; text-align: left;"
                                @if(! $event->program_link) disabled @endif
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
                    @forelse($event->compositions AS $composition)
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
                    @if(! strlen(Route::currentRouteName()))
                        <a href="{{ route('guest.event', ['event' => $event]) }}" >
                            <button style="border-radius: 1rem; padding:0 1rem; cursor: pointer;">
                                Program Detail {{ Route::currentRouteName() }}
                            </button>
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>