@props([
    'events' => $events,
    'instrumentations' => $instrumentations,
    'participant' => $participant,
    'schools' => $schools,
])
<style>
    label{font-weight: bold;}
</style>
<form method="post" action="{{ route('siteadmin.participant.update', $participant) }}" >

    @csrf

    <div class="flex flex-col mb-2">
        <label for="first">Name</label>
        <div class="flex flex-row space-x-2">
            <div class="flex flex-col">
                <input type="text" class="mr-2" name="first" id="first" value="{{ $participant->first }}"
                      placeholder="First name"/>
                @error('first')
                <div>
                    <p style="background-color: white; color: red; padding: 0 0.25rem;"
                       id="first-error">
                        {{ $errors->first('first') }}
                    </p>
                </div>
                @enderror
            </div>
            <div class="flex flex-col">
                <input type="text" name="last" id="last" value="{{ $participant->last }}" placeholder="Last name"/>
                @error('last')
                <div>
                    <p style="background-color: white; color: red; padding: 0 0.25rem;"
                       id="last-error">
                        {{ $errors->first('last') }}
                    </p>
                </div>
                @enderror
            </div>
        </div>

    </div>

    <div class="flex flex-col mb-2">
        <label for="event_id">Event</label>
        <select name="event_id">
            @foreach($events AS $event)
                <option value="{{ $event->id }}"
                    @if($event->id === $participant->event_id) selected @endif
                >
                    {{ $event->name }}
                </option>
            @endforeach
        </select>
        @error('event_id')
        <div>
            <p style="background-color: white; color: red; padding: 0 0.25rem;"
               id="event_id-error">
                {{ $errors->first('event_id') }}
            </p>
        </div>
        @enderror
    </div>

    <div class="flex flex-col mb-2">
        <label for="school_id">School</label>
        <select name="school_id">
            @foreach($schools AS $school)
                <option value="{{ $school->id }}"
                        @if($school->id === $participant->school_id) selected @endif
                >
                    {{ $school->name }}
                </option>
            @endforeach
        </select>
        @error('school_id')
        <div>
            <p style="background-color: white; color: red; padding: 0 0.25rem;"
               id="school_id-error">
                {{ $errors->first('school_id') }}
            </p>
        </div>
        @enderror
    </div>

    <div class="flex flex-col mb-2">
        <label for="instrumenatation_id">Voice Part</label>
        <select name="instrumentation_id">
            @foreach($instrumentations AS $instrumentation)
                <option value="{{ $instrumentation->id }}"
                        @if($instrumentation->id === $participant->instrumentation_id) selected @endif
                >
                    {{ $instrumentation->descr }}
                </option>
            @endforeach
        </select>
        @error('instrumentation_id')
        <div>
            <p style="background-color: white; color: red; padding: 0 0.25rem;"
               id="instrumentation_id-error">
                {{ $errors->first('instrumentation_id') }}
            </p>
        </div>
        @enderror
    </div>

    <div class="flex flex-col mb-2">
        <label for=""></label>
        <input type="submit" name="submit" id="submit" value="Update"
            class="rounded-full"
            style="background-color: rgba(0,0,255,0.5); border: 1px solid black; color: white;"
        />
    </div>

</form>
