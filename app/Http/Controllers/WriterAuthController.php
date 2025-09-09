<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Writer;
use Illuminate\Validation\ValidationException;

class WriterAuthController extends Controller
{
    /**
     * Show the writer login form.
     */
    public function showLoginForm()
    {
        return view('writer.login');
    }

    /**
     * Handle writer login.
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::guard('writer')->attempt($request->only('email', 'password'), $request->boolean('remember'))) {
            $request->session()->regenerate();
            return redirect()->intended('/writer/dashboard');
        }

        throw ValidationException::withMessages([
            'email' => ['The provided credentials are incorrect.'],
        ]);
    }

    /**
     * Show the writer register form.
     */
    public function showRegisterForm()
    {
        return view('writer.register');
    }

    /**
     * Handle writer registration.
     */
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:writers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $writer = Writer::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::guard('writer')->login($writer);

        return redirect()->intended('/writer/dashboard');
    }

    /**
     * Handle writer logout.
     */
    public function logout(Request $request)
    {
        Auth::guard('writer')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/writer/login');
    }

    /**
     * Show the writer dashboard.
     */
    public function dashboard()
    {
        return view('writer.dashboard');
    }
}