<?php

namespace App\Http\Controllers;
use App\Models\UserModel;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(){
        return view("register");
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => 'required|string|min:3',
            'confirmpassword' => 'required|string|min:3',
        ]);

        if ($request->password !== $request->confirmpassword) {
            return redirect()->route('register')->with('error', 'Password is not match!');
        }

        elseif(UserModel::where('email', $request->email)->exists()){
            return redirect()->route('register')->with('error', 'Email address already taken!');
        }

        else{
            $user = UserModel::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);
                return redirect('login')->with('success', 'Registration successful! Please login.');
        }
    }
    public function login(){
        return view('login');
    }
    public function loginpost(Request $request){

        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended('index');
        }

        return redirect()->route('login')->with('error','These credentials do not match our records');
    }
    public function logout(Request $request){
        Auth::logout(); // Logs the user out
        $request->session()->invalidate(); // Invalidate the session
        $request->session()->regenerateToken(); // Regenerate the CSRF token
        session_start();
        session_destroy();
        return redirect('login'); // Redirect to the homepage or login page
    }
}
