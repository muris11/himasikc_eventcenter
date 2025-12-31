<?php

namespace App\Livewire\Admin\BlogCategories;

use App\Models\PostCategory;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Index extends Component
{
    public function delete($id)
    {
        $category = PostCategory::findOrFail($id);

        // Check if category is being used
        if ($category->posts()->exists()) {
            session()->flash('error', 'Tidak dapat menghapus kategori karena sedang digunakan oleh postingan blog.');

            return;
        }

        $category->delete();

        session()->flash('success', 'Kategori blog berhasil dihapus.');
    }

    public function render()
    {
        return view('livewire.admin.blog-categories.index', [
            'categories' => PostCategory::all(),
        ])->layoutData([
            'title' => 'Kelola Kategori Blog - Admin Dashboard',
        ]);
    }
}
