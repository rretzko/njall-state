@extends('layouts.sydney.siteadmin')

@section('content')

    <div id="template-structure" class="flex" style="">

        <div>

            <div class="mt-1 flex justify-center px-6 pt-5 pb-6 border-2 border-gray-300 border-dashed rounded-md">
                <div class="space-y-1 text-center">
                    <div class="flex text-gray-600">
                        <form method="post" action="{{ route('siteadmin.participant.upload') }}"
                            enctype="multipart/form-data"
                            class="flex flex-col"
                            style="border: 1px solid black; padding: 0.5rem;"
                        >
                            @csrf

                            <header class="py-4 font-bold" style="font-size: large;">
                                Upload a CSV with participant data
                            </header>

                            <label for="file-upload" class="relative cursor-pointer bg-white rounded-md font-medium text-indigo-600 hover:text-indigo-500 focus-within:outline-none focus-within:ring-2 focus-within:ring-offset-2 focus-within:ring-indigo-500">
                                <input id="file-upload" name="file-upload" type="file" class="sr-only">
                            </label>

                            <input type="submit" class="mt-2 w-1/4 px-2 mx-auto rounded text-black" name="submit" id="submit" value="Upload File" />
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div><!-- end of template-structure -->


@endsection
