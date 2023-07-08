<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AdminEditStaffController extends Controller
{
    public function index()
    {
        $user = User::all();

        return view('admin.staff.index', compact('user'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('admin.staff.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Update staff details based on the form input
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        // Update other staff attributes as needed

        $user->save();

        return redirect()->route('admin.staff.index')->with('success', 'Staff details updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.staff.index')->with('success', 'Staff deleted successfully.');
    }
}
