<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function registerStaff()
    {
        return view('admin.register.staff');
    }

    public function storeStaff(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8',
            'staff_role' => 'required|in:admin,supervisor,driver,sorter',
        ]);

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role' => $validatedData['staff_role'],
        ]);

        // Debugging statements
        //dd($user->toArray()); // Inspect the created user object
        //dd(User::find($user->id)); // Verify the role value in the database

        // Additional logic as needed

        return redirect()->route('admin.dashboard')->with('message', 'Staff account created successfully!');
    }
}
