<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;

class StaffComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $complaints = Complaint::all();
        return view('staff.complaints.index', compact('complaints'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Add your implementation for creating a new complaint
        return view('staff.complaints.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Add your implementation for storing a new complaint
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Add your implementation for displaying a specific complaint
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $complaint = Complaint::findOrFail($id);
        return view('staff.complaints.edit', compact('complaint'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $complaint = Complaint::findOrFail($id);

        $data = $request->validate([
            'status' => 'required|in:open,resolved'
        ]);

        $complaint->update($data);

        return redirect()->route('staff.complaints.index')->with('message', 'Complaint status updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Add your implementation for deleting a complaint
    }
}
