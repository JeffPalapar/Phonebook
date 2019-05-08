<?php

namespace App\Http\Controllers;

use Closure;
use App\Contact;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $contacts = Contact::orderBy('cname', 'asc')->paginate(7);
        return view('home')->with('contacts', $contacts);
    }
}
