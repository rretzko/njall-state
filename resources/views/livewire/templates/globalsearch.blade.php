<div>
    <div class="input-group">
        <label for="globalsearch" class="font-bold">One-word Search</label>
        <input wire:model.debounce.ms500="globalsearch" class="rounded-full" type="text" id="globalsearch"
               placeholder="Enter search value"/>
    </div>

    <div>
        <div>
            {!! $searchresults !!}
        </div>
    </div>

</div>
