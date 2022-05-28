@props([
    'participants' => $participants
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
        <th>Voice Part</th>
        <th>Year</th>
        <th class="sr-only">Edit</th>
        <th class="sr-only">Remove</th>
    </tr>
    </thead>
    <tbody>
    @forelse($participants AS $participant)
        <tr>
            <td>
                {{ $loop->iteration }}
            </td>
            <td class="text-left">
                {{ $participant->fullnameAlpha }}
            </td>
            <td>
                {{ $participant->instrumentation->descr }}
            </td>
            <td>
                {{ $participant['event']->year_of }}
            </td>
            <td>
                <a href="{{ route('siteadmin.participant.editform', $participant) }}" >
                    <button class="px-2 my-2 rounded-full"
                            style="background-color: rgba(0,0,255,0.1); color: darkblue;"
                    >
                        Edit
                    </button>
                </a>
            </td>
            <td>
                <a href="{{ route('siteadmin.participant.remove', ['participant' => $participant]) }}" >
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
            <td colspan="6">No participants found</td>
        </tr>
    @endforelse
    </tbody>
</table>
