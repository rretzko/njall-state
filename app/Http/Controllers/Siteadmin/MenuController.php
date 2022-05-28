<?php

namespace App\Http\Controllers\Siteadmin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        return view('siteadmin.menu.index');
    }
}
