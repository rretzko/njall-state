@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.conductor.title_singular') }}:
                    {{ trans('cruds.conductor.fields.id') }}
                    {{ $conductor->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('conductor.edit', [$conductor])
        </div>
    </div>
</div>
@endsection