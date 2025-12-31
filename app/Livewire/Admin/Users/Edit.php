<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Edit extends Component
{
    public User $user;

    public $name;

    public $email;

    public $role;

    public $password;

    public $password_confirmation;

    protected $messages = [
        'email.unique' => 'Email sudah digunakan.',
        'password.min' => 'Password minimal 8 karakter.',
        'password.confirmed' => 'Konfirmasi password tidak cocok.',
    ];

    protected function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'role' => 'required|in:user,admin,super_admin',
            'password' => 'nullable|min:8|confirmed',
        ];
    }

    public function mount($user)
    {
        if (! Auth::check() || Auth::user()->role !== 'super_admin') {
            abort(403, 'Unauthorized');
        }

        if ($user instanceof User) {
            $this->user = $user;
        } else {
            $this->user = User::findOrFail($user);
        }

        $this->name = $this->user->name;
        $this->email = $this->user->email;
        $this->role = $this->user->role;
    }

    public function save()
    {
        $this->validate();

        $data = [
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ];

        // Update password if provided
        if (! empty($this->password)) {
            $data['password'] = Hash::make($this->password);
        }

        $this->user->update($data);

        session()->flash('success', 'Pengguna berhasil diperbarui.');

        return redirect()->route('admin.users.index');
    }

    public function render()
    {
        return view('livewire.admin.users.edit')->layoutData([
            'title' => 'Edit Pengguna - Admin Dashboard',
        ]);
    }
}
