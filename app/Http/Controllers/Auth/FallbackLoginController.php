<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;

class FallbackLoginController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $email = trim((string) $request->input('email'));

        // Throttle too many attempts
        $key = Str::lower($email).'|'.$request->ip();
        if (RateLimiter::tooManyAttempts($key, 5)) {
            return back()->withErrors(['email' => 'Terlalu banyak percobaan login. Silakan coba lagi beberapa saat.']);
        }

        if (Auth::attempt(['email' => $email, 'password' => $request->input('password')])) {
            session()->regenerate();
            RateLimiter::clear($key);

            return redirect()->route('admin.dashboard');
        }

        RateLimiter::hit($key);

        return back()->withErrors(['email' => 'Email atau password yang Anda masukkan tidak sesuai.']);
    }
}
