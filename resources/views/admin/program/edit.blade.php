@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.program.title_singular') }}:
                    {{ trans('cruds.program.fields.id') }}
                    {{ $program->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('program.edit', [$program])
        </div>
    </div>
</div>
@endsection