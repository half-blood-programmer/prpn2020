<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LombaController extends Controller
{
    public function kdpn()
    {
        return view('info_lomba.kdpn');
    }

    public function hstc()
    {
        return view('info_lomba.hstc');
    }

    public function mt()
    {
        return view('info_lomba.3mt');
    }

    public function tacap()
    {
        return view('info_lomba.tacap');
    }

    public function suct()
    {
        return view('info_lomba.suct');
    }
}
