@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.conductor.title_singular') }}:
                    {{ trans('cruds.conductor.fields.id') }}
                    {{ $conductor->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.conductor.fields.id') }}
                            </th>
                            <td>
                                {{ $conductor->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.conductor.fields.name') }}
                            </th>
                            <td>
                                {{ $conductor->name }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('conductor_edit')
                    <a href="{{ route('admin.conductors.edit', $conductor) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.conductors.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection