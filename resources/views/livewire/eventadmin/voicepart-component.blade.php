<div>
    <div id="inputs" class="text-center mt-4 mb-4">
        <header class="font-bold mb-2 uppercase">Select Event and Voice Part to display table...</header>
        <div class="input-group mb-2">
            <label for="eventid" class="mr-2">Event</label>
            <select wire:model="eventid" class="text-blueGray-800">
                <option value="0">Select</option>
                @foreach($events AS $event)
                    <option value="{{ $event->id }}">{{ $event->year_of }}</option>
                @endforeach
            </select>
        </div>
        <div class="input-group">
            <label for="instrumentationid" class="mr-2">Voice Part</label>
            <select wire:model="instrumentationid" class="text-blueGray-800">
                <option value="0">Select</option>
                @foreach($instrumentations AS $instrumentation)
                    <option value="{{ $instrumentation->id }}">{{ $instrumentation->descr }}</option>
                @endforeach
            </select>
        </div>
    </div>

    <div id="table" class="flex flex-col justify-center">

        <div id="switch-form" class="text-center ">
            @if($participants && $participants->count())
                <div class="input-group mb-2">
                    <label for="switchto" class="mr-2">Switch To</label>
                    <select wire:model="switchto" class="text-blueGray-800">
                        <option value="0">Select</option>
                        @foreach($instrumentations AS $instrumentation)
                            <option value="{{ $instrumentation->id }}">{{ $instrumentation->descr }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group mb-2">
                    <label></label>
                    @if($switchto)
                        <button wire:click="switchInstrumentation()" class="bg-blueGray-200 rounded px-2 text-blueGray-800"
                            style="margin-left: 2rem;"
                        >
                            Switch
                        </button>
                    @endif

                </div>
            @endif
        </div>

        <div class="flex flex-row justify-center">
            <style>
                td,th{border: 1px solid lightgray; padding: 0 .5rem;}
            </style>
            <table class="">
                <thead>
                <tr>
                    <th>###</th>
                    <th class="">Change</th>
                    <th>Name</th>
                </tr>
                </thead>
                <tbody>
                @forelse($participants AS $participant)
                    <tr style="@if($loop->odd) background-color: rgba(255,255,255,0.1); @endif">
                        <td>{{ $loop->iteration }}</td>
                        <td class="text-center">
                            <input wire:model="switches" type="checkbox" value="{{ $participant->id }}" >
                        </td>
                        <td>{{ $participant->fullnameAlpha }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center">No participants found</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
