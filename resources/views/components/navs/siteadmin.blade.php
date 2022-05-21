<div class="flex flex-col">
    @if(auth()->user())
        <a href="{{ route('siteadmin.program') }}">
            Add Program
        </a>
        <a href="{{ route('siteadmin.participant') }}">
            Add Participants
        </a>
    @endif
</div>
