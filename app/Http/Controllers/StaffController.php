<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parcel;

class StaffController extends Controller
{
    /**
     * Display the staff home page.
     */
    public function home()
    {
        $parcels = Parcel::all();
        return view('staff.home', compact('parcels'));
    }

    /**
     * Display the staff index page.
     */
    public function index()
    {
        $parcels = Parcel::all();
        return view('staff.home', compact('parcels'));
    }
}
