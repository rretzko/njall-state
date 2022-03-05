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
                Change Voice Parts
            </a>
            <a>Add Audio links</a>
            <a>Upload Event</a>
            <a>Upload Program</a>
            <a>Upload Participants</a>
        </div>
    </div>

@endsection
