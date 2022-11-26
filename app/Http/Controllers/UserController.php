<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // Show registration form
    public function create()
    {
        return view('users.register');
    }

    // Create New User
    public function store(Request $request)
    {
        // Validate the request
        $attributes = request()->validate([
            'name' => ['required', 'min:3', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users','email')],
            'password' => ['required','confirmed', 'min:6', 'max:255']
        ]);

        // Hash the password
        $attributes['password'] = bcrypt($attributes['password']);

        // Create the user
        $user = User::create($attributes);

        // Sign the user in
        auth()->login($user);

        // Redirect to the home page
        return redirect('/')->with('success', 'Your account has been created!');
    }

    // Logout
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Goodbye!');
    }

    // Show login form
    public function loginForm()
    {
        return view('users.login');
    }

    // Login
    public function authenticate(Request $request)
    {
        // Validate the request
        $attributes = request()->validate([
            'email' => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:6', 'max:255']
        ]);

        // Attempt to sign the user in
        if (auth()->attempt($attributes)) {
            $request->session()->regenerateToken();
            return redirect('/')->with('success', 'Welcome Back!');
           
        }

        // Error
        return back()->withErrors([
            'email' => 'Your provided credentials could not be verified.'
        ]) ->onlyInput('email');
        
    }
}
