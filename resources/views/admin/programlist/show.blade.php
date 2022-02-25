@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.programlist.title_singular') }}:
                    {{ trans('cruds.programlist.fields.id') }}
                    {{ $programlist->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.programlist.fields.id') }}
                            </th>
                            <td>
                                {{ $programlist->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.programlist.fields.composition') }}
                            </th>
                            <td>
                                @if($programlist->composition)
                                    <span class="badge badge-relationship">{{ $programlist->composition->title ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.programlist.fields.order_by') }}
                            </th>
                            <td>
                                {{ $programlist->order_by }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.programlist.fields.opener') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $programlist->opener ? 'checked' : '' }}>
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.programlist.fields.closer') }}
                            </th>
                            <td>
                                <input class="disabled:opacity-50 disabled:cursor-not-allowed" type="checkbox" disabled {{ $programlist->closer ? 'checked' : '' }}>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('programlist_edit')
                    <a href="{{ route('admin.programlists.edit', $programlist) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.programlists.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection