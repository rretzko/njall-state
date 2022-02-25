@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.composition.title_singular') }}:
                    {{ trans('cruds.composition.fields.id') }}
                    {{ $composition->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.composition.fields.id') }}
                            </th>
                            <td>
                                {{ $composition->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.composition.fields.title') }}
                            </th>
                            <td>
                                {{ $composition->title }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.composition.fields.subtitle') }}
                            </th>
                            <td>
                                {{ $composition->subtitle }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('composition_edit')
                    <a href="{{ route('admin.compositions.edit', $composition) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.compositions.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection