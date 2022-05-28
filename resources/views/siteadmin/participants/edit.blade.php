@extends('layouts.sydney.siteadmin')

@section('content')

    <div id="template-structure" class="flex"">

        <div >

            <div class="mt-1 flex flex-col justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">

                {{-- FILTERS --}}
                <div style="border: 1px solid black; padding: 1rem; background-color: rgba(0,0,0,0.1);">

                    <header>Please create your filter(s)</header>

                    <form method="post" action="{{ route('siteadmin.participant.show') }}">

                        @csrf

                        <div class="mb-4 flex flex-col">
                            <label for="last" class="font-bold">Last Name</label>
                            <input type="text" name="last" id="last" value="" />
                        </div>

                        <div class="mb-4 flex flex-col">
                            <label for="first" class="font-bold">First Name</label>
                            <input type="text" name="first" id="first" value="" />
                        </div>

                        <div class="mb-4 flex flex-col">
                            <label for="Year" class="font-bold">Year</label>
                            <input type="text" name="year" id="year" value="" />
                        </div>

                        <div class="mb-4 flex flex-col">
                            <label></label>
                            <input type="submit"
                                   class="rounded-full"
                                   style="border: solid 1px black"
                                   name="submit"
                                   id="submit" value="Find"
                            />
                        </div>

                    </form>
                </div>

                {{-- EDIT FORM --}}
                <div>

                    {{-- Success Message --}}
                    @if(\Session::has('success'))

                        <div style="background-color: rgba(0,255,0,0.1); color: darkgreen; margin: 1rem 0; padding: 0 1rem; border: 1px solid darkgreen; text-align: center;">
                            {!! \Session::get('success') !!}
                        </div>

                    @endif

                    @if(isset($participant))

                        <div style="border: 1px solid black; margin: 1rem 0; padding: 1rem; background-color: rgba(0,0,255,0.1);">

                            <x-forms.participant
                                :events="$events"
                                :instrumentations="$instrumentations"
                                :participant="$participant"
                                :schools="$schools"
                            />

                        </div>


                    @endif

                </div>

                {{-- TABLE --}}
                <div class="space-y-1 text-center">
                    <div class="text-gray-600">

                        <x-table.editParticipants :participants="$participants" />

                    </div>
                </div>
            </div>

        </div>

    </div><!-- end of template-structure -->


@endsection
