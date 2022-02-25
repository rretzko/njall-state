<div class="flex flex-col text-center">

    {{-- SEARCH BOX --}}
    <div id="search-box" class=" ">
        <label for="search" class="mr-2">Search</label>
        <input wire:model.debounce.500ms="search" class="text-indigo-600" type="text" placeholder="Enter participant last name" />
    </div>

    {{-- PARTICIPANT TABLE --}}
    <div id="tailwindui-table" class="flex flex-col ">
        <div class="-my-2 overflow-x-auto sm:-mx-6 lg:-mx-8">
            <div class="py-2 align-middle inline-block min-w-full sm:px-6 lg:px-8">
                <div class="shadow overflow-hidden border-b border-gray-200 sm:rounded-lg">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">###</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Name</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">School</th>
                            <th scope="col" class="relative px-6 py-3">
                                <span class="sr-only"></span>
                            </th>
                        </tr>
                        </thead>
                        <tbody class="bg-white divide-y divide-gray-200">

                        @foreach($items AS $key => $item)
                            <tr @if(($loop->iteration % 2)) style="background-color: rgba(0,0,0, .1);" @endif>
                                <td class="text-black pl-3">{{ (($page * $length) + ($key + 1)) }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-black text-left">{{ $item->fullnameAlpha }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-bold text-black text-left">{{ $item->school->name }}</td>
                                <td class="px-2">
                                    <button wire:click="setEvent({{$item->event->id }},{{ $item->id }})"
                                            class="text-indigo-600 hover:text-indigo-900 cursor-pointer px-2 bg-indigo-100 border border-blueGray-300 rounded">
                                        {{ $item->event->year_of }}
                                    </button>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>

                    <div class="my-2 px-2 flex justify-between @if($items->count() === $maxcount) justify-center  @endif">
                        <button
                            wire:click="previousPage()"
                            class="bg-blueGray-100 text-blueGray-700 px-2 rounded @if($items->count() === $maxcount) hidden @endif"
                        >
                            Prev
                        </button>
                        <div>
                            Found: {{ number_format($maxcount, 0) }}
                        </div>
                        <button
                            wire:click="nextPage()"
                            class="bg-blueGray-100 text-blueGray-700 px-2 rounded @if($items->count() === $maxcount) hidden @endif"
                        >
                            Next
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- CONDUCTOR'S PROGRAM --}}
    <div id="conductors-program" class="mt-4">

        @if($event) <x-programs.template-primary :event="$event" :participants="$participants" :participantid="$participantid"/> @endif

    </div>

</div>

