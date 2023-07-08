<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class ComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Fetch and pass the complaints data to the view
        $complaints = Complaint::all(); // Assuming you have a `Complaint` model
        return view('complaints.index', compact('complaints'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('complaints.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name' => 'required',
            'parcel_id' => 'required|exists:parcels,id',
            'complaint_details' => 'required',
        ]);

        Complaint::create($data);

        return redirect()->route('complaints.index')->with('message', 'Complaint submitted!');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Fetch the complaint by ID
        $complaint = Complaint::findOrFail($id);

        // Pass the complaint data to the view
        return view('complaints.show', compact('complaint'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $complaint = Complaint::findOrFail($id);
        return view('complaints.edit', compact('complaint'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $complaint = Complaint::findOrFail($id); // Retrieve the complaint from the database

        $data = $request->validate([
            'customer_name' => 'required',
            'parcel_id' => 'required|exists:parcels,id',
            'complaint_details' => 'required',
        ]);

        $complaint->update($data);

        return redirect()->route('complaints.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $complaint = Complaint::findOrFail($id);
        $complaint->delete();
        return redirect()->route('complaints.index');
    }
}
