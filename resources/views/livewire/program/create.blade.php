<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('program.event_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="event">{{ trans('cruds.program.fields.event') }}</label>
        <x-select-list class="form-control" required id="event" name="event" :options="$this->listsForFields['event']" wire:model="program.event_id" />
        <div class="validation-message">
            {{ $errors->first('program.event_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.program.fields.event_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.programs.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>