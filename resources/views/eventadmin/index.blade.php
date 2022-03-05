@extends('layouts.guest')
@section('content')

    <style>
        a{color: gold;}
        a:hover{color: white;}
    </style>
    <div class="text-center">
        <header class="font-bold underline uppercase mb-4"> Event Administration Functions</header>
        <div class="flex flex-col">
            <a href="{{ route('eventadmin.voicepart.edit') }}">
                Mass Change Voice Parts
            </a>
            <a class="text-gray-600">Add Audio links</a>
            <a class="text-gray-600">Edit Participant</a>
            <a class="text-gray-600">Upload Event</a>
            <a class="text-gray-600">Upload Program</a>
            <a class="text-gray-600">Upload Participants</a>
        </div>
    </div>

@endsection
