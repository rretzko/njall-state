@extends('layouts.sydney.siteadmin')

@section('content')

    <div id="template-structure" class="flex"">

        <div >

            <div class="mt-1 flex flex-col justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">

                {{-- FORM --}}
                <div style="border: 1px solid black; padding: 1rem; background-color: rgba(0,0,0,0.1);">

                    @if ($errors->any())
                        <div class="bg-white p-1 mb-2" style="color: darkred;">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <header>Please add conductor</header>

                    <form method="post" action="{{ route('siteadmin.conductor.store') }}">

                        @csrf

                        <div class="mb-4 flex flex-col">
                            <label for="name" class="font-bold">Full Name</label>
                            <input type="text" name="name" id="name" value="" placeholder="Title, First, and last name required"/>
                        </div>

                        <!-- <div class="mb-4 flex flex-col">
                       //     <label for="first" class="font-bold">First Name</label>
                       //     <input type="text" name="first" id="first" value="" />
                       // </div>

                       // <div class="mb-4 flex flex-col">
                       //     <label for="last" class="font-bold">Last Name</label>
                       //     <input type="text" name="first" id="last" value="" />
                      //  </div>
-->
                        <div class="mb-4 flex flex-col">
                            <label></label>
                            <input type="submit"
                                   class="rounded-full"
                                   style="border: solid 1px black"
                                   name="submit"
                                   id="submit" value="Add"
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

                    @if(isset($conductor))

                        <div style="border: 1px solid black; margin: 1rem 0; padding: 1rem; background-color: rgba(0,0,255,0.1);">

                            <x-forms.conductor
                                :conductor="$conductor"
                                :conductors="$conductors"
                            />

                        </div>

                    @endif

                </div>

                {{-- TABLE --}}
                <div class="space-y-1 text-center">
                    <div class="text-gray-600">

                        <x-table.editConductors :conductors="$conductors" />

                    </div>
                </div>
            </div>

        </div>

    </div><!-- end of template-structure -->


@endsection
