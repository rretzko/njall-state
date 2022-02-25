@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.instrumentation.title_singular') }}:
                    {{ trans('cruds.instrumentation.fields.id') }}
                    {{ $instrumentation->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('instrumentation.edit', [$instrumentation])
        </div>
    </div>
</div>
@endsection