<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Models\AdminModel; 

class AdminController extends Controller
{
    public function admin()
    {
        return view("admin");
    }

    public function adminRegister()
    {
        return view("adminregister"); 
    }

    public function adminstore(Request $request){
        $request->validate([
            'email' => 'required|string|email|max:255|unique:admins,email',
            'password' => 'required|string|min:3|confirmed',
        ]);
    
        // Create new admin user
        AdminModel::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
    
        return redirect()->route('admin')->with('success', 'Registration successful! Please login.');
    }

    public function adminlogin(Request $request)
    {
        // Validate the request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Retrieve the admin by email
        $admin = AdminModel::where('email', $request->email)->first();

        // Check if the admin exists and verify the password
        if ($admin && Hash::check($request->password, $admin->password)) {
            // Start session and store admin ID
            $request->session()->put('admin_id', $admin->id);
            return redirect()->route('dashboard'); // Redirect to the dashboard
        }

        // If login fails, redirect back with an error message
        return redirect()->route('admin')->with('error', 'Invalid email or password.');
    }


    public function adminlogout(Request $request)
    {
        Auth::logout(); 
        return redirect('admin');
    }
}
