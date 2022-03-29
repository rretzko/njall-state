<div>
    <div class="input-group">
        <label for="globalsearch" class="font-bold">Search by Year, Last Name or<br /> Word in Title</label>
        <input wire:model.debounce.ms500="globalsearch" class="rounded-full" type="text" id="globalsearch"
               placeholder="Enter search value"/>
    </div>

    <div>
        <div>
            {!! $searchresults !!}
        </div>
    </div>

</div>
