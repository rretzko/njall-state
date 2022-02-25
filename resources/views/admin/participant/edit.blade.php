@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.participant.title_singular') }}:
                    {{ trans('cruds.participant.fields.id') }}
                    {{ $participant->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('participant.edit', [$participant])
        </div>
    </div>
</div>
@endsection