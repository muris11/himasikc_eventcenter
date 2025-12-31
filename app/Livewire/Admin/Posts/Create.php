<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class Create extends Component
{
    use WithFileUploads;

    public $title;

    public $slug;

    public $content;

    public $is_published = false;

    public $category_id;

    public $image;

    protected $rules = [
        'title' => 'required|min:3',
        'content' => 'required',
        'is_published' => 'boolean',
        'category_id' => 'nullable|exists:post_categories,id',
        'image' => 'nullable|image|max:2048',
    ];

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }

    public function save()
    {
        $this->validate();

        // Pastikan user terautentikasi sebelum membuat post
        if (! Auth::check()) {
            session()->flash('error', 'Anda harus login untuk membuat artikel.');

            return redirect()->route('login');
        }

        $data = [
            'title' => $this->title,
            'slug' => $this->slug,
            'content' => $this->content,
            'user_id' => Auth::id(),
            'is_published' => $this->is_published,
            'post_category_id' => $this->category_id,
        ];

        if ($this->image) {
            $data['image_path'] = $this->image->store('posts', 'public');
        }

        Post::create($data);

        // Clear cache so new posts appear immediately on public pages and dashboard
        Cache::forget('blog.total_posts');
        Cache::forget('admin.dashboard.stats');
        public_cache_forget('home.latest_posts');
        public_cache_forget('home.total_posts');

        session()->flash('success', 'Artikel berhasil dibuat!');

        return redirect()->route('admin.posts.index');
    }

    public function render()
    {
        return view('livewire.admin.posts.create', [
            'categories' => PostCategory::all(),
        ])->layoutData([
            'title' => 'Buat Postingan Baru - Admin Dashboard',
        ]);
    }
}
