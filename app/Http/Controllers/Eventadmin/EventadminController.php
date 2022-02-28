<?php

namespace App\Http\Controllers\Eventadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventadminController extends Controller
{
    public function index()
    {
        return view('eventadmin.index');
    }
}
