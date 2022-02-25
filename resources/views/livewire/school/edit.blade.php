<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('school.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.school.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="school.name">
        <div class="validation-message">
            {{ $errors->first('school.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.school.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('school.city') ? 'invalid' : '' }}">
        <label class="form-label" for="city">{{ trans('cruds.school.fields.city') }}</label>
        <input class="form-control" type="text" name="city" id="city" wire:model.defer="school.city">
        <div class="validation-message">
            {{ $errors->first('school.city') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.school.fields.city_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('school.postal_code') ? 'invalid' : '' }}">
        <label class="form-label" for="postal_code">{{ trans('cruds.school.fields.postal_code') }}</label>
        <input class="form-control" type="text" name="postal_code" id="postal_code" wire:model.defer="school.postal_code">
        <div class="validation-message">
            {{ $errors->first('school.postal_code') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.school.fields.postal_code_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.schools.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>