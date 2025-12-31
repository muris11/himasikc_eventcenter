<?php

namespace App\Livewire\Admin\BlogCategories;

use App\Models\PostCategory;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Edit extends Component
{
    public PostCategory $category;

    public $name;

    public function mount($category)
    {
        if ($category instanceof PostCategory) {
            $this->category = $category;
        } else {
            $this->category = PostCategory::findOrFail($category);
        }

        $this->name = $this->category->name;
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|string|max:255',
        ]);

        $this->category->update([
            'name' => $this->name,
            'slug' => Str::slug($this->name),
        ]);

        session()->flash('success', 'Kategori blog berhasil diperbarui.');

        return redirect()->route('admin.blog-categories.index');
    }

    public function render()
    {
        return view('livewire.admin.blog-categories.edit')->layoutData([
            'title' => 'Edit Kategori Blog - Admin Dashboard',
        ]);
    }
}
