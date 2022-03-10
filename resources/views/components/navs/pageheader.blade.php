@props([
    'active' => Request::segment(2),
    'isadmin' => \App\Traits\IsAdminTrait::isAdmin(),
])

<style>
    #nav-links{background-color: rgba(37, 72, 104, 1);}
    #nav-links a {
        color: white;
        font-family: sans-serif;
        font-size: 1rem;
        margin-right: 4px;
        padding:0 0.5rem;
    }

    #nav-links a:hover{
        color: yellow;
    }

</style>
<section id="nav-pageheader" class="text-sm mt-2 border-blueGray-100 border-b " >

    <div id="nav-links" style="display: flex; justify-content: space-between; padding: 0 2rem;">

        <div id="nav-admin">

            <a href="{{ route('eventadmin.eventadmin') }}" class="mr-1 px-1 py-1 text-blueGray-600  @if($active === 'eventadmin') bg-white text-blueGray-800 @endif rounded-t text-center md:text-lg">
                Admin
            </a>

        </div>

        <div id="nav-guest">
            <a href="{{ route('guest.years') }}"
              class="mr-1 px-1 py-1 bg-blueGray-300 text-blueGray-600 @if($active === 'years') bg-white text-blueGray-800 @endif  rounded-t text-center md:text-lg ">
                Years
            </a>
            <a href="{{ route('guest.conductors') }}"
               class="mr-1 px-1 py-1 bg-blueGray-300 text-blueGray-600 @if($active === 'conductors') bg-white text-blueGray-800 @endif  rounded-t text-center md:text-lg">
                Conductors
            </a>
            <a href="{{ route('guest.participants') }}"
               class="mr-1 px-1 py-1  bg-blueGray-300 text-blueGray-600  @if($active === 'participants') bg-white text-blueGray-800 @endif rounded-t text-center md:text-lg "
            >
                Participants
            </a>
            <a href="{{ route('guest.schools') }}"
               class="mr-1 px-1 py-1  bg-blueGray-300 text-blueGray-600  @if($active === 'schools') bg-white text-blueGray-800 @endif rounded-t text-center md:text-lg">
                Schools
            </a>
            <a href="{{ route('guest.titles') }}"
               class="mr-1 px-1 py-1  bg-blueGray-300 text-blueGray-600  @if($active === 'titles') bg-white text-blueGray-800 @endif rounded-t text-center md:text-lg">
                Titles
            </a></div>

    </div>

</section>
