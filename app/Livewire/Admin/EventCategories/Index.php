<?php

namespace App\Livewire\Admin\EventCategories;

use App\Models\EventCategory;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Index extends Component
{
    public function delete($id)
    {
        $category = EventCategory::findOrFail($id);

        // Check if category is being used
        if ($category->events()->exists()) {
            session()->flash('error', 'Tidak dapat menghapus kategori karena sedang digunakan oleh event.');

            return;
        }

        $category->delete();

        session()->flash('success', 'Kategori event berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.event-categories.index', [
            'categories' => EventCategory::all(),
        ])->layoutData([
            'title' => 'Kelola Kategori Event - Admin Dashboard',
        ]);
    }
}
