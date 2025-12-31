<?php

namespace App\Livewire\Admin\EventCategories;

use App\Models\EventCategory;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Create extends Component
{
    public $name;

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        EventCategory::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        session()->flash('success', 'Kategori event berhasil dibuat.');

        return redirect()->route('admin.event-categories.index');
    }

    public function render()
    {
        return view('livewire.admin.event-categories.create')->layoutData([
            'title' => 'Buat Kategori Event Baru - Admin Dashboard',
        ]);
    }
}
