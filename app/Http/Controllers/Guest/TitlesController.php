<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class TitlesController extends Controller
{
    public function index()
    {
        return view('guests.titles');
    }
}
