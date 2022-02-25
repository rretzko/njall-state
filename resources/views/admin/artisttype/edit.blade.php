@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.artisttype.title_singular') }}:
                    {{ trans('cruds.artisttype.fields.id') }}
                    {{ $artisttype->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('artisttype.edit', [$artisttype])
        </div>
    </div>
</div>
@endsection