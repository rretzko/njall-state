@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.ensemble.title_singular') }}:
                    {{ trans('cruds.ensemble.fields.id') }}
                    {{ $ensemble->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('ensemble.edit', [$ensemble])
        </div>
    </div>
</div>
@endsection