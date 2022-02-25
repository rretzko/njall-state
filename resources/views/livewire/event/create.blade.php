<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('event.name') ? 'invalid' : '' }}">
        <label class="form-label required" for="name">{{ trans('cruds.event.fields.name') }}</label>
        <input class="form-control" type="text" name="name" id="name" required wire:model.defer="event.name">
        <div class="validation-message">
            {{ $errors->first('event.name') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.event.fields.name_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('event.year_of') ? 'invalid' : '' }}">
        <label class="form-label required" for="year_of">{{ trans('cruds.event.fields.year_of') }}</label>
        <input class="form-control" type="number" name="year_of" id="year_of" required wire:model.defer="event.year_of" step="1">
        <div class="validation-message">
            {{ $errors->first('event.year_of') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.event.fields.year_of_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.events.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>