<style>

    #nav-links a {
        border-top-left-radius: .5rem;
        border-top-right-radius: .5rem;
        font-family: "Times New Roman";
        font-size: 1.66rem;
        margin-right: 4px;
        padding:0 0.5rem;
    }

    #nav-links a:hover{
        color: darkred;
    }

</style>
<section id="nav-pageheader" class="text-sm mt-2 border-blueGray-100 border-b " >
    <div id="nav-links" class="flex sm:align-middle justify-center" >

        @if(isset($eventadmin) && $eventadmin)
            <a href="{{ route('eventadmin.eventadmin') }}" class="mr-1 px-1 py-1  bg-blueGray-300 text-blueGray-600  @if(Request::segment(2) === 'eventadmin') bg-white text-blueGray-800 @endif rounded-t text-center md:text-lg">
                Administration
            </a>
        @else
        <a href="https://njall-state.com" class="mr-1 px-1 py-1  bg-blueGray-300 text-blueGray-600  @if(Request::segment(2) === 'eventadmin') bg-white text-blueGray-800 @endif rounded-t text-center md:text-lg">
            Home
        </a>
        @endif

        <a href="{{ route('guest.years') }}" class="mr-1 px-1 py-1 bg-blueGray-300 text-blueGray-600 @if(Request::segment(2) === 'years') bg-white text-blueGray-800 @endif  rounded-t text-indigo-600 text-center md:text-lg ">
            Years
        </a>
        <a href="{{ route('guest.conductors') }}" class="mr-1 px-1 py-1 bg-blueGray-300 text-blueGray-600 @if(Request::segment(2) === 'conductors') bg-white text-blueGray-800 @endif  rounded-t text-center md:text-lg">
            Conductors
        </a>
        <a href="{{ route('guest.participants') }}"
           class="mr-1 px-1 py-1  bg-blueGray-300 text-blueGray-600  @if(Request::segment(2) === 'participants') bg-white text-blueGray-800 @endif rounded-t text-center md:text-lg "
        >
            Participants
        </a>
        <a href="{{ route('guest.schools') }}" class="mr-1 px-1 py-1  bg-blueGray-300 text-blueGray-600  @if(Request::segment(2) === 'schools') bg-white text-blueGray-800 @endif rounded-t text-center md:text-lg">
            Schools
        </a>
        <a href="{{ route('guest.titles') }}" class="mr-1 px-1 py-1  bg-blueGray-300 text-blueGray-600  @if(Request::segment(2) === 'titles') bg-white text-blueGray-800 @endif rounded-t text-center md:text-lg">
            Titles
        </a>

    </div>
</section>
