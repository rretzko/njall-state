<form wire:submit.prevent="submit" class="pt-3">

    <div class="form-group {{ $errors->has('programlist.composition_id') ? 'invalid' : '' }}">
        <label class="form-label required" for="composition">{{ trans('cruds.programlist.fields.composition') }}</label>
        <x-select-list class="form-control" required id="composition" name="composition" :options="$this->listsForFields['composition']" wire:model="programlist.composition_id" />
        <div class="validation-message">
            {{ $errors->first('programlist.composition_id') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.programlist.fields.composition_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('programlist.order_by') ? 'invalid' : '' }}">
        <label class="form-label required" for="order_by">{{ trans('cruds.programlist.fields.order_by') }}</label>
        <input class="form-control" type="number" name="order_by" id="order_by" required wire:model.defer="programlist.order_by" step="1">
        <div class="validation-message">
            {{ $errors->first('programlist.order_by') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.programlist.fields.order_by_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('programlist.opener') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="opener" id="opener" wire:model.defer="programlist.opener">
        <label class="form-label inline ml-1" for="opener">{{ trans('cruds.programlist.fields.opener') }}</label>
        <div class="validation-message">
            {{ $errors->first('programlist.opener') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.programlist.fields.opener_helper') }}
        </div>
    </div>
    <div class="form-group {{ $errors->has('programlist.closer') ? 'invalid' : '' }}">
        <input class="form-control" type="checkbox" name="closer" id="closer" wire:model.defer="programlist.closer">
        <label class="form-label inline ml-1" for="closer">{{ trans('cruds.programlist.fields.closer') }}</label>
        <div class="validation-message">
            {{ $errors->first('programlist.closer') }}
        </div>
        <div class="help-block">
            {{ trans('cruds.programlist.fields.closer_helper') }}
        </div>
    </div>

    <div class="form-group">
        <button class="btn btn-indigo mr-2" type="submit">
            {{ trans('global.save') }}
        </button>
        <a href="{{ route('admin.programlists.index') }}" class="btn btn-secondary">
            {{ trans('global.cancel') }}
        </a>
    </div>
</form>
