<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller {

    // Show login form
    public function showLoginForm() {
        return view('login');
    }

    // Handle login request
    public function login(Request $request) {
        $credentials = $request->validate([
            'email' => ['required', 'email'], // Validate email
            'password' => ['required'], // Validate password
        ]);

        // Attempt login
        if (Auth::attempt($credentials)) {
            session(['name' => Auth::user()->name, 'user_id' => Auth::user()->id]); // Store user info
            $request->session()->regenerate(); // Regenerate session
            return redirect()->intended('/dashboard'); // Redirect to dashboard
        }

        // Failed login
        return back()->withErrors(['email' => 'Invalid credentials'])->onlyInput('email');
    }

    // Handle logout
    public function logout(Request $request) {
        Auth::logout(); // Log out the user
        $request->session()->invalidate(); // Invalidate session
        $request->session()->regenerateToken(); // Regenerate CSRF token
        session()->forget('name'); // Forget session data
        return redirect('/login'); // Redirect to login
    }
}

