<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

use App\Competition;
use App\Data;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $competition = Competition::whereId(Auth::user()->id_competition)->first();
        $data_user = Data::whereId_user(Auth::user()->id)->first();
        return view('home', ['competition' => $competition, 'data_user' => $data_user]);
    }
}
