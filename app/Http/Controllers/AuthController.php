<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $user = User::where('username', $credentials['username'])->first();

        if (!$user) {
            return back()->withErrors([
                'username' => 'Username tidak ditemukan, silahkan coba lagi.',
            ])->onlyInput('username');
        }

        if (!Hash::check($credentials['password'], $user->password)) {
            return back()->withErrors([
                'password' => 'Password anda salah, silahkan coba lagi.',
            ])->onlyInput('username');
        }

        Auth::login($user);
        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function account(Request $request)
    {
        $user = Auth::user();
        return view('auth.account', compact('user'));
    }

    public function changeName(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        /** @var \App\Models\User $user **/
        $user->name = $request->name;
        $user->save();

        return redirect()->route('account');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        $user = Auth::user();

        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors([
                'current_password' => 'Password saat ini tidak sesuai.',
            ]);
        }

        /** @var \App\Models\User $user **/
        $user->password = Hash::make($request->new_password);
        $user->save();

        return redirect()->route('account');
    }
}
