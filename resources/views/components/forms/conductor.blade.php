@props([
    'conductor' => $conductor,
    'conductors' => $conductors,
])
<style>
    label{font-weight: bold;}
</style>
<form method="post" action="{{ route('siteadmin.conductor.update', $conductor) }}" >

    @csrf

    <div class="flex flex-col mb-2">
        <label for="name">Full Name</label>
        <div class="flex flex-row space-x-2">
            <div class="flex flex-col">
                <input type="text" class="mr-2" style="width: 60rem;" name="name" id="name" value="{{ $conductor->name }}"
                      placeholder="Full name"/>
                @error('name')
                <div>
                    <p style="background-color: white; color: red; padding: 0 0.25rem;"
                       id="name-error">
                        {{ $errors->first('name') }}
                    </p>
                </div>
                @enderror
            </div>
        </div>
    </div>

    <div class="flex flex-col mb-2">
        <label for="first">First name</label>
        <div class="flex flex-row space-x-2">
            <div class="flex flex-col">
                {{ $conductor->first }}
            </div>
        </div>
    </div>

    <div class="flex flex-col mb-2">
        <label for="last">Last name</label>
        <div class="flex flex-row space-x-2">
            <div class="flex flex-col">
                {{ $conductor->last }}
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
