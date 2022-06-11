<div class="flex flex-col ">

    @if(auth()->user())

        <div class="flex flex-col" style="padding: 0.5rem 0;">
            <a href="{{ route('siteadmin.event') }}">
                Add Event
            </a>

            <a href="{{ route('siteadmin.program') }}">
                Add Program
            </a>

            <a href="{{ route('siteadmin.participant') }}">
                Add Participants
            </a>
        </div>

        <div  class="flex flex-col" style="border-top: 1px solid darkgrey; padding: 0.5rem 0;">

            <a href="{{ route('siteadmin.event') }}">
                Edit Event
            </a>
            <a href="{{ route('siteadmin.participant.edit') }}">
                Edit Participant
            </a>

        </div>

    @endif

</div>

<div style="margin-top: 1rem; color: rgba(0,0,0,0.3);">

    <x-punchlist />

</div>
