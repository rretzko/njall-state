@props([
    'active' => Request::segment(2),
    'isadmin' => \App\Traits\IsAdminTrait::isAdmin(),
])

<style>
    #nav-links{background-color: rgba(37, 72, 104, 1); margin-bottom: 3rem;}
    #nav-links a {
        color: white;
        font-family: sans-serif;
        font-size: 1rem;
        margin-right: 4px;
        padding:0 0.5rem;
    }

    #nav-links a:hover{
        color: gold;
    }

    .active {
        border-bottom: 4px solid gold;
        margin-bottom: 1rem;
    }

</style>
<section id="nav-pageheader" class="text-sm mt-2 border-blueGray-100 border-b " >

    <div id="nav-links" style="display: flex; justify-content: space-between; padding: 0.5rem 2rem; ">

        <div id="nav-site-home">

            <a href="{{ route('home') }}"
                class="mr-1 px-1 py-1 rounded-t text-center md:text-lg">
                NJ All-State Chorus History
            </a>

        </div>

        <div id="nav-guest">

            @auth
                @if(auth()->user()->isSiteAdmin)
                    <a href="{{ route('siteadmin.menu') }}"
                       class="mr-1 px-1 py-1 rounded-t text-center md:text-lg @if($active === 'siteadmin') active @endif" >
                        Admin
                    </a>
                @endif
            @endauth

            <a href="{{ route('home') }}"
               class="mr-1 px-1 py-1 rounded-t text-center md:text-lg @if(($active === 'home') || (! isset($active))) active @endif" >
                Home
            </a>

            <a href="{{ route('guest.programs') }}"
               class="mr-1 px-1 py-1 rounded-t text-center md:text-lg @if($active === 'programs') active @endif" >
                Programs
            </a>

<!-- {{--
            <a href="{{ route('guest.events') }}"
               class="mr-1 px-1 py-1 rounded-t text-center md:text-lg @if($active === 'events') active @endif" >
                Events
            </a>

            <a href="{{ route('guest.years') }}"
              class="mr-1 px-1 py-1 @if($active === 'years') bg-white text-blueGray-800 @endif  rounded-t text-center md:text-lg ">
                Years
            </a>
--}} -->
            <a href="{{ route('guest.conductors') }}"
               class="mr-1 px-1 py-1 @if($active === 'conductors') bg-white text-blueGray-800 @endif  rounded-t text-center md:text-lg">
                Conductors
            </a>
<!-- {{--
            <a href="{{ route('guest.participants') }}"
               class="mr-1 px-1 py-1   @if($active === 'participants') bg-white text-blueGray-800 @endif rounded-t text-center md:text-lg "
            >
                Participants
            </a>
--}} -->
            <a href="{{ route('guest.schools') }}"
               class="mr-1 px-1 py-1  @if($active === 'schools') bg-white text-blueGray-800 @endif rounded-t text-center md:text-lg">
                Schools
            </a>

            <a href="{{ route('guest.titles') }}"
               class="mr-1 px-1 py-1  @if($active === 'titles') bg-white text-blueGray-800 @endif rounded-t text-center md:text-lg">
                Titles
            </a>
            @auth
                <a href="{{ route('logout') }}"
                   class="mr-1 px-1 py-1 rounded-t text-center md:text-lg">
                    LogOut
                </a>
            @endauth
        </div>

    </div>

</section>
