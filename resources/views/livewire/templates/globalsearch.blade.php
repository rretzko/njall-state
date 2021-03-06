<div>
    <div class="input-group flex flex-col">
        <label for="globalsearch" class="font-bold">Search by Year, Last Name or<br /> Word in Title</label>
        <input wire:model.debounce.500ms="globalsearch" class="rounded-full" type="text" id="globalsearch"
               placeholder="Enter search value"/>
    </div>

    <div>
        <div>
            {!! $searchresults !!}
        </div>
    </div>

    <div>
        <div>
            {!! $alphaconductors !!}
        </div>

        <div>
            {!! $alphaschools !!}
        </div>
    </div>

</div>
