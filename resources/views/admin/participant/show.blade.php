@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.participant.title_singular') }}:
                    {{ trans('cruds.participant.fields.id') }}
                    {{ $participant->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.participant.fields.id') }}
                            </th>
                            <td>
                                {{ $participant->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.participant.fields.first') }}
                            </th>
                            <td>
                                {{ $participant->first }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.participant.fields.last') }}
                            </th>
                            <td>
                                {{ $participant->last }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.participant.fields.instrumentation') }}
                            </th>
                            <td>
                                @if($participant->instrumentation)
                                    <span class="badge badge-relationship">{{ $participant->instrumentation->descr ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.participant.fields.school') }}
                            </th>
                            <td>
                                @if($participant->school)
                                    <span class="badge badge-relationship">{{ $participant->school->name ?? '' }}</span>
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('participant_edit')
                    <a href="{{ route('admin.participants.edit', $participant) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.participants.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection