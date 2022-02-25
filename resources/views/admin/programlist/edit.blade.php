@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.edit') }}
                    {{ trans('cruds.programlist.title_singular') }}:
                    {{ trans('cruds.programlist.fields.id') }}
                    {{ $programlist->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            @livewire('programlist.edit', [$programlist])
        </div>
    </div>
</div>
@endsection