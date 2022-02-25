<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('participant.first') ? 'invalid' : '' }}">
        <label class="form-label required" for="first">{{ trans('cruds.participant.fields.first') }}</label>
        <input class="form-control" type="text" name="first" id="first" required wire:model.defer="participant.first">
        <div class="validation-message">
            {{ $errors->first('participant.first') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.participant.fields.first_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('participant.last') ? 'invalid' : '' }}">
        <label class="form-label required" for="last">{{ trans('cruds.participant.fields.last') }}</label>
        <input class="form-control" type="text" name="last" id="last" required wire:model.defer="participant.last">
        <div class="validation-message">
            {{ $errors->first('participant.last') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.participant.fields.last_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('participant.instrumentation_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="instrumentation">{{ trans('cruds.participant.fields.instrumentation') }}</label>
        <x-select-list class="form-control" required id="instrumentation" name="instrumentation" :options="$this->listsForFields['instrumentation']" wire:model="participant.instrumentation_id" />
        <div class="validation-message">
            {{ $errors->first('participant.instrumentation_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.participant.fields.instrumentation_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('participant.school_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="school">{{ trans('cruds.participant.fields.school') }}</label>
        <x-select-list class="form-control" required id="school" name="school" :options="$this->listsForFields['school']" wire:model="participant.school_id" />
        <div class="validation-message">
            {{ $errors->first('participant.school_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.participant.fields.school_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.participants.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>