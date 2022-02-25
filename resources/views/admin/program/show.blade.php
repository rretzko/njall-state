@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.program.title_singular') }}:
                    {{ trans('cruds.program.fields.id') }}
                    {{ $program->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.program.fields.id') }}
                            </th>
                            <td>
                                {{ $program->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.program.fields.event') }}
                            </th>
                            <td>
                                @if($program->event)
                                    <span class="badge badge-relationship">{{ $program->event->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('program_edit')
                    <a href="{{ route('admin.programs.edit', $program) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.programs.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection