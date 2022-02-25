<div>
    <div class="card-controls sm:flex">
        <div class="w-full sm:w-1/2">
            Per page:
            <select wire:model="perPage" class="form-select w-full sm:w-1/6">
                @foreach($paginationOptions as $value)
                    <option value="{{ $value }}">{{ $value }}</option>
                @endforeach
            </select>

            @can('programlist_delete')
                <button class="btn btn-rose ml-3 disabled:opacity-50 disabled:cursor-not-allowed" type="button" wire:click="confirm('deleteSelected')" wire:loading.attr="disabled" {{ $this->selectedCount ? '' : 'disabled' }}>
                    {{ __('Delete Selected') }}
                </button>
            @endcan

            @if(file_exists(app_path('Http/Livewire/ExcelExport.php')))
                <livewire:excel-export model="Programlist" format="csv" />
                <livewire:excel-export model="Programlist" format="xlsx" />
                <livewire:excel-export model="Programlist" format="pdf" />
            @endif




        </div>
        <div class="w-full sm:w-1/2 sm:text-right">
            Search:
            <input type="text" wire:model.debounce.300ms="search" class="w-full sm:w-1/3 inline-block" />
        </div>
    </div>
    <div wire:loading.delay>
        Loading...
    </div>

    <div class="overflow-hidden">
        <div class="overflow-x-auto">
            <table class="table table-index w-full">
                <thead>
                    <tr>
                        <th class="w-9">
                        </th>
                        <th class="w-28">
                            {{ trans('cruds.programlist.fields.id') }}
                            @include('components.table.sort', ['field' => 'id'])
                        </th>
                        <th>
                            {{ trans('cruds.programlist.fields.composition') }}
                            @include('components.table.sort', ['field' => 'composition.title'])
                        </th>
                        <th>
                            {{ trans('cruds.programlist.fields.order_by') }}
                            @include('components.table.sort', ['field' => 'order_by'])
                        </th>
                        <th>
                            {{ trans('cruds.programlist.fields.opener') }}
                            @include('components.table.sort', ['field' => 'opener'])
                        </th>
                        <th>
                            {{ trans('cruds.programlist.fields.closer') }}
                            @include('components.table.sort', ['field' => 'closer'])
                        </th>
                        <th>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($programlists as $programlist)
                        <tr>
                            <td>
                                <input type="checkbox" value="{{ $programlist->id }}" wire:model="selected">
                            </td>
                            <td>
                                {{ $programlist->id }}
                            </td>
                            <td>
                                @if($programlist->composition)
                                    <span class="badge badge-relationship">{{ $programlist->composition->title ?? '' }}</span>
                                @endif
                            </td>
                            <td>
                                {{ $programlist->order_by }}
                            </td>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $programlist->opener ? 'checked' : '' }}>
                            </td>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $programlist->closer ? 'checked' : '' }}>
                            </td>
                            <td>
                                <div class="flex justify-end">
                                    @can('programlist_show')
                                        <a class="btn btn-sm btn-info mr-2" href="{{ route('admin.programlists.show', $programlist) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                    @endcan
                                    @can('programlist_edit')
                                        <a class="btn btn-sm btn-success mr-2" href="{{ route('admin.programlists.edit', $programlist) }}">
                                            {{ trans('global.edit') }}
                                        </a>
                                    @endcan
                                    @can('programlist_delete')
                                        <button class="btn btn-sm btn-rose mr-2" type="button" wire:click="confirm('delete', {{ $programlist->id }})" wire:loading.attr="disabled">
                                            {{ trans('global.delete') }}
                                        </button>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="10">No entries found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div class="card-body">
        <div class="pt-3">
            @if($this->selectedCount)
                <p class="text-sm leading-5">
                    <span class="font-medium">
                        {{ $this->selectedCount }}
                    </span>
                    {{ __('Entries selected') }}
                </p>
            @endif
            {{ $programlists->links() }}
        </div>
    </div>
</div>

@push('scripts')
    <script>
        Livewire.on('confirm', e => {
    if (!confirm("{{ trans('global.areYouSure') }}")) {
        return
    }
@this[e.callback](...e.argv)
})
    </script>
@endpush