@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.instrumentation.title_singular') }}:
                    {{ trans('cruds.instrumentation.fields.id') }}
                    {{ $instrumentation->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.instrumentation.fields.id') }}
                            </th>
                            <td>
                                {{ $instrumentation->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.instrumentation.fields.descr') }}
                            </th>
                            <td>
                                {{ $instrumentation->descr }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.instrumentation.fields.abbr') }}
                            </th>
                            <td>
                                {{ $instrumentation->abbr }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('instrumentation_edit')
                    <a href="{{ route('admin.instrumentations.edit', $instrumentation) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.instrumentations.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection