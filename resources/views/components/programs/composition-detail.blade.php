@props([
    'composition',
    'compositionid' => 0,
    'event',
    'iteration' => 1,
])
<div class="py-1 flex flex-row justify-center
    @if($composition->pivot->combined) font-bold @endif
    @if($composition->pivot->opener || $composition->pivot->closer) italic @endif"
     style="{{ ($iteration % 2) ?: 'background-color: rgba(255,255,255,.1);' }}"
>
        <span style="@if($composition->id == $compositionid) color: gold; @endif" title="{{ $composition->id }}">
            {{ $composition->title }}
        </span>
    @if($composition->pivot->combined) (combined) @endif

    @forelse($composition->composers AS $composer)
        <span class="text-sm" style="font-style: italic; padding-top: 4px; margin-left: 0.5rem;">
            {{ $composer->fullname }}
        </span>
    @empty
        {{-- do nothing --}}
    @endforelse

    @forelse($composition->arrangers AS $arranger)
        <span class="text-sm" style="font-style: italic; padding-top: 4px; margin-left: 0.5rem;" >
            arr. {{ $arranger->fullname }}
        </span>
    @empty
        {{-- do nothing --}}
    @endforelse

    @if($composition->media->count() && $composition->media->where('event_id', $event->id))

        <div class="ml-2 text-xs" style="padding-top: 4px;">

            <div class="play-icon cursor-pointer" style="padding-bottom: 2px;" onclick="playthis('/assets/media/audio/09 What Would You Do if you Married a Soldier-Mack Wilberg.mp3')">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM9.555 7.168A1 1 0 008 8v4a1 1 0 001.555.832l3-2a1 1 0 000-1.664l-3-2z" clip-rule="evenodd" />
                </svg>
            </div>
        </div>

    @endif

</div>
