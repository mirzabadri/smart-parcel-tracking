<?php

namespace App\Http\Controllers;

use App\Models\Parcel;

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // Fetch the parcel data from your database or any other source
        $parcelData = Parcel::all(); // Replace 'Parcel' with your actual model name or data source
    
        return view('home', compact('parcelData'));
    }
}
