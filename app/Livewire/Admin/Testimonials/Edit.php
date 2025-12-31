<?php

namespace App\Livewire\Admin\Testimonials;

use App\Models\Testimonial;
use function App\Providers\public_cache_forget;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class Edit extends Component
{
    use WithFileUploads;

    public Testimonial $testimonial;

    public $name;
    public $role;
    public $content;
    public $avatar;
    public $newAvatar;
    public $is_active;

    protected $rules = [
        'name' => 'required|string|max:255',
        'role' => 'required|string|max:255',
        'content' => 'required|string',
        'newAvatar' => 'nullable|image|max:1024', // 1MB Max
        'is_active' => 'boolean',
    ];

    public function mount(Testimonial $testimonial)
    {
        $this->testimonial = $testimonial;
        $this->name = $testimonial->name;
        $this->role = $testimonial->role;
        $this->content = $testimonial->content;
        $this->avatar = $testimonial->avatar;
        $this->is_active = $testimonial->is_active;
    }

    public function save()
    {
        $this->validate();

        $avatarPath = $this->avatar;
        if ($this->newAvatar) {
            if ($this->avatar) {
                Storage::disk('public')->delete($this->avatar);
            }
            $avatarPath = $this->newAvatar->store('testimonials', 'public');
        }

        $this->testimonial->update([
            'name' => $this->name,
            'role' => $this->role,
            'content' => $this->content,
            'avatar' => $avatarPath,
            'is_active' => $this->is_active,
        ]);

        public_cache_forget('home.testimonials');

        session()->flash('success', 'Testimoni berhasil diperbarui!');

        return redirect()->route('admin.testimonials.index');
    }

    public function render()
    {
        return view('livewire.admin.testimonials.edit')->layoutData([
            'title' => 'Edit Testimoni - Admin Dashboard',
        ]);
    }
}
