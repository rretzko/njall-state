<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('instrumentation.descr') ? 'invalid' : '' }}">
        <label class="form-label required" for="descr">{{ trans('cruds.instrumentation.fields.descr') }}</label>
        <input class="form-control" type="text" name="descr" id="descr" required wire:model.defer="instrumentation.descr">
        <div class="validation-message">
            {{ $errors->first('instrumentation.descr') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.instrumentation.fields.descr_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('instrumentation.abbr') ? 'invalid' : '' }}">
        <label class="form-label required" for="abbr">{{ trans('cruds.instrumentation.fields.abbr') }}</label>
        <input class="form-control" type="text" name="abbr" id="abbr" required wire:model.defer="instrumentation.abbr">
        <div class="validation-message">
            {{ $errors->first('instrumentation.abbr') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.instrumentation.fields.abbr_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.instrumentations.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>