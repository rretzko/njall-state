@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="card bg-blueGray-100">
        <div class="card-header">
            <div class="card-header-container">
                <h6 class="card-title">
                    {{ trans('global.view') }}
                    {{ trans('cruds.artist.title_singular') }}:
                    {{ trans('cruds.artist.fields.id') }}
                    {{ $artist->id }}
                </h6>
            </div>
        </div>

        <div class="card-body">
            <div class="pt-3">
                <table class="table table-view">
                    <tbody class="bg-white">
                        <tr>
                            <th>
                                {{ trans('cruds.artist.fields.id') }}
                            </th>
                            <td>
                                {{ $artist->id }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.artist.fields.name') }}
                            </th>
                            <td>
                                {{ $artist->name }}
                            </td>
                        </tr>
                        <tr>
                            <th>
                                {{ trans('cruds.artist.fields.artisttype') }}
                            </th>
                            <td>
                                @foreach($artist->artisttype as $key => $entry)
                                    <span class="badge badge-relationship">{{ $entry->descr }}</span>
                                @endforeach
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="form-group">
                @can('artist_edit')
                    <a href="{{ route('admin.artists.edit', $artist) }}" class="btn btn-indigo mr-2">
                        {{ trans('global.edit') }}
                    </a>
                @endcan
                <a href="{{ route('admin.artists.index') }}" class="btn btn-secondary">
                    {{ trans('global.back') }}
                </a>
            </div>
        </div>
    </div>
</div>
@endsection