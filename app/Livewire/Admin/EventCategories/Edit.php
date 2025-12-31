<?php

namespace App\Livewire\Admin\EventCategories;

use App\Models\EventCategory;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Edit extends Component
{
    public EventCategory $category;

    public $name;

    public function mount($category)
    {
        if ($category instanceof EventCategory) {
            $this->category = $category;
        } else {
            $this->category = EventCategory::findOrFail($category);
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

        session()->flash('success', 'Kategori event berhasil diperbarui.');

        return redirect()->route('admin.event-categories.index');
    }

    public function render()
    {
        return view('livewire.admin.event-categories.edit')->layoutData([
            'title' => 'Edit Kategori Event - Admin Dashboard',
        ]);
    }
}
