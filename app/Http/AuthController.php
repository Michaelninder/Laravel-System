<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $incomingValues = $request->validate([
            'username' => ['required', 'min:5', 'max:20', 'unique:users,username'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
        ]);
    
        $incomingValues['uuid'] = (string) Str::uuid();
        $incomingValues['role'] = 'user';
        $incomingValues['password'] = Hash::make($incomingValues['password']);
        $incomingValues['balance'] = 0.00;


        $user = User::create($incomingValues);

        if ($request->has('autologin')) {
            Auth::login($user);
        }

        return redirect()->route('dashboard.overview')->with('success', __('auth.register_success'));
    }


    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
    
        $remember = $request->filled('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('dashboard.overview')->with('success', __('auth.login_success'));
        }

        return back()->withErrors([
            'email' => __('auth.invalid_credentials'),
        ])->withInput();        
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login')->with('success', __('auth.logout_success'));
    }

}
