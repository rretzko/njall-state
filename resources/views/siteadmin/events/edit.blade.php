@extends('layouts.sydney.siteadmin')

@section('content')

    <div id="template-structure" class="flex"">

        <div >

            <div class="mt-1 flex flex-col justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">

                {{-- EDIT EVENT --}}
                <div>

                    {{-- Success Message --}}
                    @if(\Session::has('success'))

                        <div style="background-color: rgba(0,255,0,0.1); color: darkgreen; margin: 1rem 0; padding: 0 1rem; border: 1px solid darkgreen; text-align: center;">
                            {!! \Session::get('success') !!}
                        </div>

                    @endif

                    @if(isset($event))

                        <div style="border: 1px solid black; margin: 1rem 0; padding: 1rem; background-color: rgba(0,0,255,0.1);">

                            <x-forms.event
                                :event="$event"
                                :events="$events"
                            />

                        </div>

                    @endif

                </div>

                {{-- TABLE --}}
                <div class="space-y-1 text-center">
                    <div class="text-gray-600">

                        <x-table.editEvents :events="$events" />

                    </div>
                </div>
            </div>

        </div>

    </div><!-- end of template-structure -->


@endsection
