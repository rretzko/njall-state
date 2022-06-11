@props([
    'event' => $event,
    'events' => $events,
])
<style>
    label{font-weight: bold;}
</style>
<form method="post" action="{{ route('siteadmin.event.update', $event) }}" >

    @csrf

    <div class="flex flex-col mb-2">
        <label for="name">Name</label>
        <div class="flex flex-row space-x-2">
            <div class="flex flex-col">
                <input type="text" class="mr-2" style="width: 60rem;" name="name" id="name" value="{{ $event->name }}"
                      placeholder="Event name"/>
                @error('name')
                <div>
                    <p style="background-color: white; color: red; padding: 0 0.25rem;"
                       id="name-error">
                        {{ $errors->first('first') }}
                    </p>
                </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="flex flex-col mb-2">
        <label for="year_of">Year</label>
        <div class="flex flex-row space-x-2">
            <div class="flex flex-col">
                <input type="number" class="mr-2"  style="width: 6rem;" name="year_of" id="year_of" value="{{ $event->year_of }}"
                       placeholder="Year"/>
                @error('year_of')
                <div>
                    <p style="background-color: white; color: red; padding: 0 0.25rem;"
                       id="name-error">
                        {{ $errors->first('year_of') }}
                    </p>
                </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="flex flex-col mb-2">
        <label for="program_link">Program Link</label>
        <div class="flex flex-row space-x-2">
            <div class="flex flex-col">
                <input type="text" class="mr-2" style="width: 60rem;" name="program_link" id="program_link" value="{{ $event->program_link }}"
                       placeholder="Program link"/>
                @error('program_link')
                <div>
                    <p style="background-color: white; color: red; padding: 0 0.25rem;"
                       id="program_link-error">
                        {{ $errors->first('program_link') }}
                    </p>
                </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="flex flex-col mb-2">
        <label for=""></label>
        <input type="submit" name="submit" id="submit" value="Update"
            class="rounded-full"
            style="background-color: rgba(0,0,255,0.5); border: 1px solid black; color: white;"
        />
    </div>

</form>
