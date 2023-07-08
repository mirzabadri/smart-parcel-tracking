<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;
use App\Notifications\ParcelDelivered;
use Twilio\Rest\Client;


class ParcelController extends Controller
{
    public function scanPage()
    {
        return view('staff.scan.parcel');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $parcels = Parcel::all();
        return view('parcels.index', compact('parcels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        //return view('parcels.create');
        $trackingNumber = $this->generateTrackingNumber();
        return view('parcels.create', ['trackingNumber' => $trackingNumber]);
    }

    private function generateTrackingNumber()
    {
        // Generate the tracking number logic here
        // For example, you can use a combination of current timestamp and a random number
        $timestamp = time();
        $random = rand(10000, 99999);
        $trackingNumber = $timestamp . $random;
        return $trackingNumber;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'sender_name' => 'required',
            'sender_address' => 'required',
            'sender_phone_number' => 'required',
            'receiver_name' => 'required',
            'receiver_address' => 'required',
            'receiver_phone_number' => 'required',
            'weight' => 'required|numeric',
            'description' => 'nullable',
            'tracking_number' => 'required|unique:parcels'
        ]);

        Parcel::create($data);
        return redirect()->route('parcels.index')->with('message', 'Parcel created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
        $parcel = Parcel::findOrFail($id);
        return view('parcels.show', compact('parcel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $parcel = Parcel::findOrFail($id);
        return view('parcels.edit', compact('parcel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $parcel = Parcel::findOrFail($id); // Retrieve the parcel from the database

        $data = $request->validate([
            'sender_name' => 'required',
            'sender_address' => 'required',
            'sender_phone_number' => 'required',
            'receiver_name' => 'required',
            'receiver_address' => 'required',
            'receiver_phone_number' => 'required',
            'weight' => 'required|numeric',
            'description' => 'nullable',
            'tracking_number' => 'required|unique:parcels,tracking_number,' . $parcel->id
        ]);

        $parcel->update($data);

        return redirect()->route('parcels.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $parcel = Parcel::findOrFail($id);
        $parcel->delete();
        return redirect()->route('parcels.index');
    }
}
