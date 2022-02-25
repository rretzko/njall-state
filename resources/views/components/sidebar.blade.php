<nav class="md:left-0 md:block md:fixed md:top-0 md:bottom-0 md:overflow-y-auto md:flex-row md:flex-nowrap md:overflow-hidden shadow-xl bg-white flex flex-wrap items-center justify-between relative md:w-64 z-10 py-4 px-6">
    <div class="md:flex-col md:items-stretch md:min-h-full md:flex-nowrap px-0 flex flex-wrap items-center justify-between w-full mx-auto">
        <button class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" type="button" onclick="toggleNavbar('example-collapse-sidebar')">
            <i class="fas fa-bars"></i>
        </button>
        <a class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0" href="{{ route('admin.home') }}">
            {{ trans('panel.site_title') }}
        </a>
        <div class="md:flex md:flex-col md:items-stretch md:opacity-100 md:relative md:mt-4 md:shadow-none shadow absolute top-0 left-0 right-0 z-40 overflow-y-auto overflow-x-hidden h-auto items-center flex-1 rounded hidden" id="example-collapse-sidebar">
            <div class="md:min-w-full md:hidden block pb-4 mb-4 border-b border-solid border-blueGray-300">
                <div class="flex flex-wrap">
                    <div class="w-6/12">
                        <a class="md:block text-left md:pb-2 text-blueGray-700 mr-0 inline-block whitespace-nowrap text-sm uppercase font-bold p-4 px-0" href="{{ route('admin.home') }}">
                            {{ trans('panel.site_title') }}
                        </a>
                    </div>
                    <div class="w-6/12 flex justify-end">
                        <button type="button" class="cursor-pointer text-black opacity-50 md:hidden px-3 py-1 text-xl leading-none bg-transparent rounded border border-solid border-transparent" onclick="toggleNavbar('example-collapse-sidebar')">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                </div>
            </div>

            <form class="mt-6 mb-4 md:hidden">
                <div class="mb-3 pt-0">
                    @livewire('global-search')
                </div>
            </form>

            <!-- Divider -->
            <div class="flex md:hidden">
                @if(file_exists(app_path('Http/Livewire/LanguageSwitcher.php')))
                    <livewire:language-switcher />
                @endif
            </div>
            <hr class="mb-6 md:min-w-full" />
            <!-- Heading -->

            <ul class="md:flex-col md:min-w-full flex flex-col list-none">
                <li class="items-center">
                    <a href="{{ route("admin.home") }}" class="{{ request()->is("admin") ? "sidebar-nav-active" : "sidebar-nav" }}">
                        <i class="fas fa-tv"></i>
                        {{ trans('global.dashboard') }}
                    </a>
                </li>

                @can('user_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/permissions*")||request()->is("admin/roles*")||request()->is("admin/users*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-users">
                            </i>
                            {{ trans('cruds.userManagement.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('permission_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/permissions*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.permissions.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-unlock-alt">
                                        </i>
                                        {{ trans('cruds.permission.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('role_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/roles*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.roles.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-briefcase">
                                        </i>
                                        {{ trans('cruds.role.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('user_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/users*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.users.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-user">
                                        </i>
                                        {{ trans('cruds.user.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan
                @can('event_management_access')
                    <li class="items-center">
                        <a class="has-sub {{ request()->is("admin/events*")||request()->is("admin/ensembles*")||request()->is("admin/conductors*")||request()->is("admin/compositions*")||request()->is("admin/artists*")||request()->is("admin/artisttypes*")||request()->is("admin/schools*")||request()->is("admin/instrumentations*")||request()->is("admin/participants*")||request()->is("admin/programs*")||request()->is("admin/programlists*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                            <i class="fa-fw fas c-sidebar-nav-icon fa-cogs">
                            </i>
                            {{ trans('cruds.eventManagement.title') }}
                        </a>
                        <ul class="ml-4 subnav hidden">
                            @can('event_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/events*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.events.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.event.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('ensemble_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/ensembles*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.ensembles.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.ensemble.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('conductor_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/conductors*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.conductors.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.conductor.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('composition_management_access')
                                <li class="items-center">
                                    <a class="has-sub {{ request()->is("admin/compositions*")||request()->is("admin/artists*")||request()->is("admin/artisttypes*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                                        <i class="fa-fw fas c-sidebar-nav-icon fa-cogs">
                                        </i>
                                        {{ trans('cruds.compositionManagement.title') }}
                                    </a>
                                    <ul class="ml-4 subnav hidden">
                                        @can('composition_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is("admin/compositions*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.compositions.index") }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                                    </i>
                                                    {{ trans('cruds.composition.title') }}
                                                </a>
                                            </li>
                                        @endcan
                                        @can('artist_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is("admin/artists*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.artists.index") }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                                    </i>
                                                    {{ trans('cruds.artist.title') }}
                                                </a>
                                            </li>
                                        @endcan
                                        @can('artisttype_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is("admin/artisttypes*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.artisttypes.index") }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                                    </i>
                                                    {{ trans('cruds.artisttype.title') }}
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('participant_management_access')
                                <li class="items-center">
                                    <a class="has-sub {{ request()->is("admin/schools*")||request()->is("admin/instrumentations*")||request()->is("admin/participants*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="#" onclick="window.openSubNav(this)">
                                        <i class="fa-fw fas c-sidebar-nav-icon fa-cogs">
                                        </i>
                                        {{ trans('cruds.participantManagement.title') }}
                                    </a>
                                    <ul class="ml-4 subnav hidden">
                                        @can('school_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is("admin/schools*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.schools.index") }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                                    </i>
                                                    {{ trans('cruds.school.title') }}
                                                </a>
                                            </li>
                                        @endcan
                                        @can('instrumentation_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is("admin/instrumentations*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.instrumentations.index") }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                                    </i>
                                                    {{ trans('cruds.instrumentation.title') }}
                                                </a>
                                            </li>
                                        @endcan
                                        @can('participant_access')
                                            <li class="items-center">
                                                <a class="{{ request()->is("admin/participants*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.participants.index") }}">
                                                    <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                                    </i>
                                                    {{ trans('cruds.participant.title') }}
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </li>
                            @endcan
                            @can('program_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/programs*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.programs.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.program.title') }}
                                    </a>
                                </li>
                            @endcan
                            @can('programlist_access')
                                <li class="items-center">
                                    <a class="{{ request()->is("admin/programlists*") ? "sidebar-nav-active" : "sidebar-nav" }}" href="{{ route("admin.programlists.index") }}">
                                        <i class="fa-fw c-sidebar-nav-icon fas fa-cogs">
                                        </i>
                                        {{ trans('cruds.programlist.title') }}
                                    </a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @if(file_exists(app_path('Http/Controllers/Auth/UserProfileController.php')))
                    @can('auth_profile_edit')
                        <li class="items-center">
                            <a href="{{ route("profile.show") }}" class="{{ request()->is("profile") ? "sidebar-nav-active" : "sidebar-nav" }}">
                                <i class="fa-fw c-sidebar-nav-icon fas fa-user-circle"></i>
                                {{ trans('global.my_profile') }}
                            </a>
                        </li>
                    @endcan
                @endif

                <li class="items-center">
                    <a href="#" onclick="event.preventDefault(); document.getElementById('logoutform').submit();" class="sidebar-nav">
                        <i class="fa-fw fas fa-sign-out-alt"></i>
                        {{ trans('global.logout') }}
                    </a>
                </li>
            </ul>
        </div>
    </div>
</nav>