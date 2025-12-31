<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $name;

    public $email;

    public $password;

    public $role = 'user';

    public $userId;

    public $isEditing = false;

    public $showModal = false;

    public $search = '';

    public $roleFilter = '';

    public $perPage = 10;

    protected $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'role' => 'required|in:user,admin',
    ];

    protected $messages = [
        'email.unique' => 'Email sudah digunakan.',
    ];

    public function mount()
    {
        // Access control is handled by EnsureUserIsSuperAdmin middleware
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingRoleFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = User::query();

        // Search functionality
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%'.$this->search.'%')
                    ->orWhere('email', 'like', '%'.$this->search.'%');
            });
        }

        // Role filter
        if ($this->roleFilter !== '') {
            $query->where('role', $this->roleFilter);
        }

        $users = $query->latest()->paginate($this->perPage);

        return view('livewire.admin.users.index', compact('users'))->layoutData([
            'title' => 'Kelola Pengguna - Admin Dashboard',
        ]);
    }

    public function openModal()
    {
        $this->resetForm();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->showModal = false;
        $this->resetForm();
    }

    public function createUser()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role,
        ]);

        session()->flash('success', 'Pengguna berhasil ditambahkan.');
        $this->closeModal();
    }

    public function editUser($id)
    {
        $user = User::findOrFail($id);
        $this->userId = $user->id;
        $this->name = $user->name;
        $this->email = $user->email;
        $this->role = $user->role;
        $this->isEditing = true;
        $this->showModal = true;
    }

    public function updateUser()
    {
        $this->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$this->userId,
            'role' => 'required|in:user,admin',
        ]);

        $user = User::findOrFail($this->userId);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
        ]);

        session()->flash('success', 'Pengguna berhasil diupdate.');
        $this->closeModal();
    }

    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        if ($user->role === 'super_admin') {
            session()->flash('error', 'Tidak dapat menghapus super admin.');

            return;
        }
        $user->delete();
        session()->flash('success', 'Pengguna berhasil dihapus.');
    }

    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->role = 'user';
        $this->userId = null;
        $this->isEditing = false;
    }
}
