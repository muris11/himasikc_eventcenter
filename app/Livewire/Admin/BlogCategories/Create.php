<?php

namespace App\Livewire\Admin\BlogCategories;

use App\Models\PostCategory;
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

        PostCategory::create([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        session()->flash('success', 'Kategori blog berhasil dibuat.');

        return redirect()->route('admin.blog-categories.index');
    }

    public function render()
    {
        return view('livewire.admin.blog-categories.create')->layoutData([
            'title' => 'Buat Kategori Blog Baru - Admin Dashboard',
        ]);
    }
}
