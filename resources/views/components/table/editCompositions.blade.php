@props([
    'compositions' => $compositions
])
<style>
    table{border-collapse: collapse;margin: 1rem 0;}
    td,th{border: 1px solid black; padding: 0 0.25rem; color: black;}
</style>

<style>
    #compositions_table a{ color: blue;}
</style>
<table id="compositions_table">
    <thead>
    <tr>
        <th>###</th>
        <th title="Sort by title">
            <a href="{{ route('siteadmin.compositions') }}">
                Title
            </a>
        </th>
        <th>
            Artist(s)
        </th>
        <th title="Sort by times used in performance">
            <a href="{{ route('siteadmin.compositions', [ 'by' => 'count']) }}">
                Count
            </a>
        </th>
        <th class="sr-only">Edit</th>
        <th class="sr-only">Remove</th>
    </tr>
    </thead>
    <tbody>
    @forelse($compositions AS $composition)
        <tr>
            <td>
                {{ $loop->iteration }}
            </td>
            <td class="text-left"
                title="Sys.Id. {{ $composition->id }}"
            >
                {{ $composition->title }}
            </td>
            <td class="text-left">
                {!! implode('<br />', $composition->artistBlock) !!}
            </td>
            <td class="text-center">
                {{ $composition->performanceCount }}
            </td>
            <td>
                <a href="{{ route('siteadmin.composition.edit', $composition) }}" >
                    <button class="px-2 my-2 rounded-full"
                            style="background-color: rgba(0,0,255,0.1); color: darkblue;"
                    >
                        Edit
                    </button>
                </a>
            </td>
            <td>
                <a href="{{ route('siteadmin.composition.remove', $composition) }}" >
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
            <td colspan="6">No compositions found</td>
        </tr>
    @endforelse
    </tbody>
</table>
