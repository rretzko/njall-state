<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('composition.title') ? 'invalid' : '' }}">
        <label class="form-label required" for="title">{{ trans('cruds.composition.fields.title') }}</label>
        <input class="form-control" type="text" name="title" id="title" required wire:model.defer="composition.title">
        <div class="validation-message">
            {{ $errors->first('composition.title') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.composition.fields.title_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('composition.subtitle') ? 'invalid' : '' }}">
        <label class="form-label" for="subtitle">{{ trans('cruds.composition.fields.subtitle') }}</label>
        <input class="form-control" type="text" name="subtitle" id="subtitle" wire:model.defer="composition.subtitle">
        <div class="validation-message">
            {{ $errors->first('composition.subtitle') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.composition.fields.subtitle_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.compositions.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>