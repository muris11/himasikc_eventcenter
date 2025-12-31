<?php

namespace App\Livewire\Admin\Testimonials;

use App\Models\Testimonial;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class Create extends Component
{
    use WithFileUploads;

    public $name;
    public $role;
    public $content;
    public $avatar;
    public $is_active = true;

    protected $rules = [
        'name' => 'required|string|max:255',
        'role' => 'required|string|max:255',
        'content' => 'required|string',
        'avatar' => 'nullable|image|max:1024', // 1MB Max
        'is_active' => 'boolean',
    ];

    public function save()
    {
        $this->validate();

        $avatarPath = null;
        if ($this->avatar) {
            $avatarPath = $this->avatar->store('testimonials', 'public');
        }

        Testimonial::create([
            'name' => $this->name,
            'role' => $this->role,
            'content' => $this->content,
            'avatar' => $avatarPath,
            'is_active' => $this->is_active,
        ]);

        public_cache_forget('home.testimonials');

        session()->flash('success', 'Testimoni berhasil ditambahkan!');

        return redirect()->route('admin.testimonials.index');
    }

    public function render()
    {
        return view('livewire.admin.testimonials.create')->layoutData([
            'title' => 'Tambah Testimoni - Admin Dashboard',
        ]);
    }
}
