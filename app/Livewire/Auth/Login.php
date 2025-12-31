<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Login extends Component
{
    public $email;

    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required',
    ];

    public function mount(): void
    {
        if (Auth::check()) {
            $this->redirect(route('admin.dashboard'), navigate: true);
        }
    }

    public function login()
    {
        \Illuminate\Support\Facades\Log::info('Login method called');

        $this->validate();

        $email = trim((string) $this->email);

        \Illuminate\Support\Facades\Log::info('Attempting login for: '.$email);

        if ($this->hasTooManyLoginAttempts($email)) {
            \Illuminate\Support\Facades\Log::warning('Too many login attempts for: '.$email);
            $this->addError('email', 'Terlalu banyak percobaan login. Silakan coba lagi beberapa saat.');

            return;
        }

        if (Auth::attempt(['email' => $email, 'password' => $this->password])) {
            \Illuminate\Support\Facades\Log::info('Login successful for: '.$email);
            session()->regenerate();
            RateLimiter::clear($this->throttleKey($email));

            // Redirect using Livewire v3 redirect method
            \Illuminate\Support\Facades\Log::info('Redirecting to admin dashboard...');

            return redirect()->route('admin.dashboard');
        }

        \Illuminate\Support\Facades\Log::warning('Login failed for: '.$email);
        RateLimiter::hit($this->throttleKey($email));

        $this->addError('email', 'Email atau password yang Anda masukkan tidak sesuai.');
    }

    protected function throttleKey(string $email): string
    {
        return Str::lower($email).'|'.request()->ip();
    }

    protected function hasTooManyLoginAttempts(string $email): bool
    {
        return RateLimiter::tooManyAttempts(
            $this->throttleKey($email),
            5 // attempts
        );
    }

    public function render()
    {
        return view('livewire.auth.login')->layoutData([
            'title' => 'Login Admin',
            'description' => 'Halaman login admin untuk mengelola konten HIMA SIKC Event Center.',
            'keywords' => 'login admin, hima sikc, dashboard',
            'canonical' => url()->current(),
        ]);
    }
}
