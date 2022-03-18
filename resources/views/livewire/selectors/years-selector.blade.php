<div id="selectors" class="" style="display: flex; justify-content: space-around; width: 40%; margin: auto; margin-bottom: 1rem;">
    <div wire:click="previousYear" id="previous" style="padding: 0.4rem 0; cursor:pointer; display: flex; vertical-align: center;">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" style="padding-top: 0.2rem;">
            <path fill-rule="evenodd" d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" />
        </svg>
        {{ $previous }}
    </div>
    <div id="current" style="font-size: 1.5rem;">{{ $current }}</div>
    <div wire:click="nextYear" id="next" style="padding: 0.4rem 0; cursor: pointer; display: flex;">
        {{ $next }}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor" >
            <path fill-rule="evenodd" d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" />
        </svg>
    </div>
</div>
