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

    public function users(Request $request){
        $query = $request->input('input');
        $users = UserModel::select('id', 'name', 'email', 'role','address') 
            ->where('role', '!=', 'admin') 
            ->paginate(5);
        
        $userCount = UserModel::where('role', '!=', 'admin')->count();
        $notification = Order::whereColumn('created_at', 'updated_at')->count();
        $count = $users->total(); 
        return view('users', compact('users', 'userCount','count','query','notification'));

    }

    public function admins(Request $request){
        $query = $request->input('input');
        $users = UserModel::select('id', 'name', 'email', 'role','address') 
            ->where('role',  'admin') 
            ->paginate(5);
        $adminCount = UserModel::where('role', 'admin')->count();
        $notification = Order::whereColumn('created_at', 'updated_at')->count();
        $count = $users->total(); 
        return view('admins', compact('users', 'adminCount','count','query','notification'));

    }

    public function adduser(){
        return view('add-user');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:8|max:20|regex:/^[A-Za-z\s]+$/',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
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
                'address' => $request->address,
                'password' => Hash::make($request->password),
                'role' => $request->input('userrole'), 
            ]);
                return redirect('login')->with('success', 'Registration successful! Please login.');
        }
    }

    public function add(Request $request){
        $request->validate([
            'name' => 'required|string|min:8|max:20|regex:/^[A-Za-z\s]+$/',
            'email' => 'required|string|email|max:255|unique:users',
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:user,admin',
        ]);
        UserModel::create([
            'name' => $request->name,
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password), 
            'role' => $request->role,
        ]);
        return redirect()->route('admins')->with('success', 'User added successfully!');
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
            $user = Auth::user();
            if ($user->role === 'admin') {
                return redirect()->route('dashboard'); 
            } else {
                return redirect()->intended('index');
            }
        }
        else{
            return redirect('login')->with('error','The provided credentials do not match our records.');
        }
    
    }
    public function logout(Request $request){
        Auth::logout(); 
        $request->session()->invalidate(); 
        $request->session()->regenerateToken(); 
        session_start();
        session_destroy();
        return redirect('login');
    }

    public function admin()
    {
        return view("admin");
    }

    public function adminreg()
    {
        return view("adminregister"); 
    }

    public function registerpost(Request $request){
        $request->validate([
            'name' => 'required|string|min:8|max:20|regex:/^[A-Za-z\s]+$/',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);
        UserModel::create([
            'name' => $request->name, 
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password), 
            'role' => 'admin', 
        ]);
        return redirect()->route('login')->with('success', 'Admin registered successfully!');
    }


    public function registers(Request $request){
        $request->validate([
            'name' => 'required|string|min:8|max:20|regex:/^[A-Za-z\s]+$/',
            'email' => 'required|email|unique:users,email',
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
        ]);
        UserModel::create([
            'name' => $request->name, 
            'email' => $request->email,
            'address' => $request->address,
            'password' => Hash::make($request->password), 
            'role' => 'user', 
        ]);
        return redirect()->route('login')->with('success', 'User registered successfully!');
    }


    public function edituser($id){
        $user = UserModel::findOrFail($id); 
        return view('edit-user', compact('user'));
    }

    public function updateuser(Request $request, $id){
        $request->validate([
            'name' => 'required|string|min:8|max:20|regex:/^[A-Za-z\s]+$/',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'password' => 'nullable|string|min:8',
            'address' => 'required|string|max:255',
            'role' => 'required|string|in:user,admin',
        ]);
    
        $user = UserModel::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->address = $request->address;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->save();
    
        return redirect()->route('admins')->with('success', 'User updated successfully.');
    }

    public function updateprofile(Request $request, $id){
        $request->validate([
            'name' => 'required|string|min:8|max:20|regex:/^[A-Za-z\s]+$/',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:8',
            'role' => 'required|string|in:user,admin',
        ]);
    
        $user = UserModel::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }
        $user->role = $request->role;
        $user->address = $request->address;
        $user->save();
        return redirect()->route('index')->with('success', 'Profile Updated Successfully.');
    }

    public function deleteuser($id){
        $user = UserModel::findOrFail($id);
        $user -> delete();
        return redirect()->route('admins')->with('success','User Deleted Successfully.');
    }
}
