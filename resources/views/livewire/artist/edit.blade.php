<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('artist.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.artist.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="artist.name">
        <div class="validation-message">
            {{ $errors->first('artist.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artist.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('artisttype') ? 'invalid' : '' }}">
        <label class="form-label" for="artisttype">{{ trans('cruds.artist.fields.artisttype') }}</label>
        <x-select-list class="form-control" id="artisttype" name="artisttype" wire:model="artisttype" :options="$this->listsForFields['artisttype']" multiple />
        <div class="validation-message">
            {{ $errors->first('artisttype') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.artist.fields.artisttype_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.artists.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>