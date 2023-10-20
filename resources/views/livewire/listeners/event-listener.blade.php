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

                {{-- MEDIA LINKs --}}
                <div id="media-links" class="flex flex-row">

                    {{-- PROGRAM LINK --}}
                    <div style="margin: 0.5rem 0; margin-right: 1rem;">
                        <a href="{{ $event->program_link }}" @if(! $event->program_link) disabled @endif target="_NEW" style="text-align: left;">
                            <button style="border-radius: 1rem; cursor: pointer; color: blue; font-size: 0.8rem; text-align: left;"
                                    @if(! $event->program_link) disabled @endif
                            >
                                Program PDF
                            </button>
                        </a>
                    </div>

                    {{-- VIDEO LINK --}}
                    <div style="margin: 0.5rem 0;">
                        @if(! is_null($event->video_link))
                            <a href="{{ $event->video_link }}" @if(! $event->video_link) disabled @endif target="_NEW" style="text-align: left;">
                                <button style="border-radius: 1rem; cursor: pointer; color: blue; font-size: 0.8rem; text-align: left;"
                                        @if(! $event->video_link) disabled @endif
                                >
                                    Video Link
                                </button>
                            </a>
                        @endif
                    </div>

                </div>

                {{-- CHORUS IMAGE
                <div>
                    <img src="{{ asset('/images/1984_mixed.jpg') }}" />
                </div>
--}}
            </div>
            <div id="program-card" style="width: 66%; text-align: left; padding: 0 .5rem;">
                <header style="font-weight: bold; margin: 0.5rem 0;">
                    Program
                </header>
                <div>
                    @forelse($event->compositions AS $composition)
                        <div style="display: flex; flex-direction: column;">
                            <div style="display: flex; flex-direction: row;">
                                <div style="width: 60%; display: flex; flex-direction: row;" title="{{ $composition->title }}">
                                    {{ trim(substr($composition->title, 0, 30)) }}@if(strlen($composition->title) > 30)... @endif
                                    @if($composition->hasRecording())
                                        <div style="height: 20px; width: 20px; margin-left: 0.5rem; margin-top: 4px; ">
                                            <a href="{{ $composition->getAudioLink() }}" target="_blank" style="color: blue;">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                                     stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                          d="M19.114 5.636a9 9 0 010 12.728M16.463 8.288a5.25 5.25 0 010 7.424M6.75 8.25l4.72-4.72a.75.75 0 011.28.53v15.88a.75.75 0 01-1.28.53l-4.72-4.72H4.51c-.88 0-1.704-.507-1.938-1.354A9.01 9.01 0 012.25 12c0-.83.112-1.633.322-2.396C2.806 8.756 3.63 8.25 4.51 8.25H6.75z"/>
                                                </svg>
                                            </a>
                                        </div>
                                    @endif
                                </div>
                                <div style="width: 38%; font-size: 1rem; margin-left: 1rem;">
                                    @foreach($composition->composers AS $composer)
                                        <i>{{ $composer->fullname }}</i>
                                    @endforeach
                                        @foreach($composition->arrangers AS $arranger)
                                            <i>arr. {{ $arranger->fullname }}</i>
                                        @endforeach
                                </div>
                            </div>
                        </div>
                    @empty
                        @if($event->cancellation)
                            <div>
                                Program cancelled due to: {{ ucwords($event->cancellation->descr) }}.
                            </div>
                            @else
                            <div>No program found</div>
                        @endif
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

    <div class="px-8 mb-2">
        @if(is_null($event->image_link))
            <div class="text-center">
                <a href="mailto:rick@mfrholdings.com?subject=NJ-All State Chorus photo&body=Hi Rick, I've attached a photo for the {{ $event->name }}."
                    class="text-center text-blue-500 w-full"
                >
                    Got a Mixed Chorus photo? Send it in!
                </a>
            </div>
        @else
            <a href="{{ $event->image_link }}" target="_BLANK">
                <img class="mb-2" src="{{ $event->image_link }}" width=""/>
            </a>
        @endif
    </div>

</div>
