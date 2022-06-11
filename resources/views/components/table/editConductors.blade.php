@props([
    'conductors' => $conductors
])
<style>
    table{border-collapse: collapse;margin: 1rem 0;}
    td,th{border: 1px solid black; padding: 0 0.25rem; color: black;}
</style>

<style>
    #conductors_table a{ color: blue;}
</style>
<table id="conductors_table">
    <thead>
    <tr>
        <th>###</th>
        <th>Full Name</th>
        <th>First Name</th>
        <th>
            <a href="{{ route('siteadmin.conductors') }}">
                Last Name
            </a>
        </th>
        <th>
            <a href="{{ route('siteadmin.conductors.byyear', 1) }}" style="color: blue;">
                Year(s)
            </a>
        </th>
        <th class="sr-only">Edit</th>
        <th class="sr-only">Remove</th>
    </tr>
    </thead>
    <tbody>
    @forelse($conductors AS $conductor)
        <tr>
            <td>
                {{ $loop->iteration }}
            </td>
            <td class="text-left">
                {{ $conductor->name }}
            </td>
            <td>
                {{ $conductor->first }}
            </td>
            <td>
                {{ $conductor->last }}
            </td>
            <td>
                {{ $conductor->years }}
            </td>
            <td>
                <a href="{{ route('siteadmin.conductor.edit', $conductor) }}" >
                    <button class="px-2 my-2 rounded-full"
                            style="background-color: rgba(0,0,255,0.1); color: darkblue;"
                    >
                        Edit
                    </button>
                </a>
            </td>
            <td>
                <a href="{{ route('siteadmin.conductor.remove', $conductor) }}" >
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
