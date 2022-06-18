@props([
    'composition' => $composition,
    'compositions' => $compositions,
    'similars' => $similars,
])
<style>
    label{font-weight: bold;}
</style>
<form method="post" action="{{ route('siteadmin.composition.update', $composition) }}" >

    @csrf

    {{-- System Id --}}
    <div class="flex flex-row mb-2">
        <label for="title">Sys.Id.</label>
        <div class="ml-4">{{ $composition->id }}</div>
    </div>

    {{-- TITLE --}}
    <div class="flex flex-col mb-2">
        <label for="title">Title</label>
        <div class="flex flex-row space-x-2">
            <div class="flex flex-col">
                <input type="text" class="mr-2" style="width: 60rem;" name="title" id="title" value="{{ $composition->title }}"
                       placeholder="Title""
                />
                @error('title')
                <div>
                    <p style="background-color: white; color: red; padding: 0 0.25rem;"
                       id="name-error">
                        {{ $errors->first('title') }}
                    </p>
                </div>
                @enderror
            </div>
        </div>
    </div>

    {{-- COMPOSER --}}
    <div class="flex flex-col mb-2">
        <label for="composer">Composer</label>
        <div class="flex flex-row space-x-2">
            <div class="flex flex-col">
                <input type="text" class="mr-2" style="width: 60rem;" name="composer" id="composer" value="{{ $composition->artisttypeString($composition->composers) }}"
                       placeholder="composer"
                />
                @error('composer')
                <div>
                    <p style="background-color: white; color: red; padding: 0 0.25rem;"
                       id="name-error">
                        {{ $errors->first('composer') }}
                    </p>
                </div>
                @enderror
            </div>
        </div>
    </div>

    {{-- ARRANGER --}}
    <div class="flex flex-col mb-2">
        <label for="arranger">Arranger</label>
        <div class="flex flex-row space-x-2">
            <div class="flex flex-col">
                <input type="text" class="mr-2" style="width: 60rem;" name="arranger" id="arranger" value="{{ $composition->artisttypeString($composition->arrangers) }}"
                       placeholder="arranger"
                />
                @error('arranger')
                <div>
                    <p style="background-color: white; color: red; padding: 0 0.25rem;"
                       id="name-error">
                        {{ $errors->first('arranger') }}
                    </p>
                </div>
                @enderror
            </div>
        </div>
    </div>

    {{-- SUBMIT --}}
    <div class="flex flex-col mb-2">
        <label for=""></label>
        <input type="submit" name="submit" id="submit" value="Update"
            class="rounded-full"
            style="background-color: rgba(0,0,255,0.5); border: 1px solid black; color: white;"
        />
    </div>

    {{-- SIMILARS --}}
    <div id="similars">
        @if($similars->count())
            <hr class="mt-6 mb-3" style="border: 1px solid white;"/>
            <header class="font-bold">Click the title below to replace this with that:</header>
            <ul>
                @foreach($similars AS $similar)
                    <li>
                        <a href="{{ route('siteadmin.composition.replace',['old' => $composition->id,'new' => $similar->id]) }}">
                            {{ $similar->title }} ({{ implode(', ', $similar->artistBlock) }})
                        </a>
                    </li>
                @endforeach
            </ul>
        @endif
    </div>

</form>
