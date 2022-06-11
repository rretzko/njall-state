@props([
    'events' => $events
])
<style>
    table{border-collapse: collapse;margin: 1rem 0;}
    td,th{border: 1px solid black; padding: 0 0.25rem; color: black;}
</style>

<table>
    <thead>
    <tr>
        <th>###</th>
        <th>Name</th>
        <th>Year</th>
        <th>Program Link</th>
        <th class="sr-only">Edit</th>
        <th class="sr-only">Remove</th>
    </tr>
    </thead>
    <tbody>
    @forelse($events AS $event)
        <tr>
            <td>
                {{ $loop->iteration }}
            </td>
            <td class="text-left">
                {{ $event->name }}
            </td>
            <td>
                {{ $event->year_of }}
            </td>
            <td>
                {{ $event->program_link }}
            </td>
            <td>
                <a href="{{ route('siteadmin.event.edit', $event) }}" >
                    <button class="px-2 my-2 rounded-full"
                            style="background-color: rgba(0,0,255,0.1); color: darkblue;"
                    >
                        Edit
                    </button>
                </a>
            </td>
            <td>
                <a href="{{ route('siteadmin.event.remove', ['event' => $event]) }}" >
                    <button class="px-2 my-2 rounded-full"
                            style="background-color: rgba(255,0,0,0.1); color: darkred;"
                    >
                        Remove
                    </button>
                </a>
            </td>
        </tr>
    @empty
        <tr>
            <td colspan="6">No events found</td>
        </tr>
    @endforelse
    </tbody>
</table>
