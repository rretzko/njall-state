<?php

namespace App\Http\Controllers\Eventadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventadminController extends Controller
{
    public function index()
    {dd(__LINE__);
        $eventadmin = (($_SERVER['REMOTE_ADDR'] === '127.0.0.1') || ($_SERVER['REMOTE_ADDR'] === '10.244.10.21'))
            ? true
            : false;

        return view('eventadmin.index', ['eventadmin' => $eventadmin]);
    }
}
