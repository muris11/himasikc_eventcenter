<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Create extends Component
{
    public $name;

    public $email;

    public $password;

    public $password_confirmation;

    public $role = 'user';

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8|confirmed',
        'role' => 'required|in:user,admin',
    ];

    protected $messages = [
        'email.unique' => 'Email sudah digunakan.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ];

    public function mount()
    {
        // Access control is handled by EnsureUserIsSuperAdmin middleware
    }

    public function save()
    {
        $this->validate();

        try {
            User::create([
                'name' => $this->name,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'role' => $this->role,
            ]);

            session()->flash('success', 'Pengguna berhasil dibuat!');

            return redirect()->route('admin.users.index');
        } catch (\Exception $e) {
            session()->flash('error', 'Terjadi kesalahan saat membuat pengguna: '.$e->getMessage());

            return back();
        }
    }

    public function render()
    {
        return view('livewire.admin.users.create')->layoutData([
            'title' => 'Buat Pengguna Baru - Admin Dashboard',
        ]);
    }
}
