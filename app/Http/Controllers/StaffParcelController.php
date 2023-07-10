<?php

namespace App\Http\Controllers;

use App\Models\Parcel;
use Illuminate\Http\Request;
use App\Notifications\ParcelDelivered;
use Twilio\Rest\Client;
use Twilio\Exceptions\TwilioException;
use App\Models\TrackingHistory;



class StaffParcelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $parcels = Parcel::all();
        return view('staff.parcels.index', compact('parcels'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /*return view('staff.parcels.create');*/
        $trackingNumber = $this->generateTrackingNumber();
        return view('staff.parcels.create', ['trackingNumber' => $trackingNumber]);
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
        $data = $request->validate([
            'sender_name' => 'required',
            'sender_address' => 'required',
            'sender_phone_number' => 'required',
            'receiver_name' => 'required',
            'receiver_address' => 'required',
            'weight' => 'required|numeric',
            'description' => 'nullable',
            'tracking_number' => 'required|unique:parcels'
        ]);

        Parcel::create($data);
        return redirect()->route('staff.parcels.index')->with('message', 'Parcel created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $parcel = Parcel::findOrFail($id);
        return view('staff.parcels.show', compact('parcel'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $parcel = Parcel::where('id', $id)
                        ->orWhere('tracking_number', $id)
                        ->firstOrFail();

        return view('staff.parcels.edit', compact('parcel'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $parcel = Parcel::findOrFail($id);

        $data = $request->validate([
            'status' => 'required|in:pending,in_transit,delivered',
            'sender_name' => 'required',
        ]);

        $parcel->update($data);

        $trackingHistory = new TrackingHistory();
        $trackingHistory->parcel_id = $parcel->id;
        $trackingHistory->status = $parcel->status;
        $trackingHistory->save();

        /*if($data['status'] === 'delivered') {
            $parcel->user->notify(new \App\Notifications\ParcelDelivered($parcel));
        }*/
        if ($data['status'] === 'delivered') {
            try {
                $twilioSid = env('TWILIO_SID');
                $twilioAuthToken = env('TWILIO_AUTH_TOKEN');
                $twilioPhoneNumber = env('TWILIO_PHONE_NUMBER');
        
                $client = new Client($twilioSid, $twilioAuthToken);
        
                $recipientPhoneNumber = $parcel->receiver_phone_number;
                $message = "Your parcel has been delivered!";
        
                $client->messages->create(
                    "whatsapp:" . $recipientPhoneNumber,
                    [
                        'from' => "whatsapp:" . $twilioPhoneNumber,
                        'body' => $message,
                    ]
                );
                dd($e->getMessage());
            } catch (TwilioException $e) {
                // Handle Twilio exception if something goes wrong with sending the WhatsApp message
            }
            //dd($e->getMessage());
        }
        

        return redirect()->route('staff.parcels.index')->with('message', 'Parcel status updated!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $parcel = Parcel::findOrFail($id);
        $parcel->delete();
        return redirect()->route('staff.parcels.index');
    }
}
