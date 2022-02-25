@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.school.title_singular') }}:
                    {{ trans('cruds.school.fields.id') }}
                    {{ $school->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.school.fields.id') }}
                            </th>
                            <td>
                                {{ $school->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.school.fields.name') }}
                            </th>
                            <td>
                                {{ $school->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.school.fields.city') }}
                            </th>
                            <td>
                                {{ $school->city }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.school.fields.postal_code') }}
                            </th>
                            <td>
                                {{ $school->postal_code }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('school_edit')
                    <a href="{{ route('admin.schools.edit', $school) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.schools.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection