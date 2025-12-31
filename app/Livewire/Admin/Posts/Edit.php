<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use App\Models\PostCategory;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class Edit extends Component
{
    use WithFileUploads;

    public Post $post;

    public $title;

    public $slug;

    public $content;

    public $is_published;

    public $category_id;

    public $image;

    protected $rules = [
        'title' => 'required|min:3',
        'content' => 'required',
        'is_published' => 'boolean',
        'category_id' => 'nullable|exists:post_categories,id',
        'image' => 'nullable|image|max:2048',
    ];

    public function mount($post)
    {
        if ($post instanceof Post) {
            $this->post = $post;
        } else {
            $this->post = Post::findOrFail($post);
        }

        $this->title = $this->post->title;
        $this->slug = $this->post->slug;
        $this->content = $this->post->content;
        $this->is_published = $this->post->is_published;
        $this->category_id = $this->post->post_category_id;
    }

    public function updatedTitle($value)
    {
        $this->slug = Str::slug($value);
    }

    public function save()
    {
        $this->validate();

        // Generate unique slug
        $baseSlug = Str::slug($this->title);
        $slug = $baseSlug;
        $counter = 1;

        // Ensure unique slug, excluding current post
        while (Post::where('slug', $slug)->where('id', '!=', $this->post->id)->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        $data = [
            'title' => $this->title,
            'slug' => $slug,
            'content' => $this->content,
            'is_published' => $this->is_published,
            'post_category_id' => $this->category_id,
        ];

        if ($this->image) {
            // Delete old image if exists
            if ($this->post->image_path && Storage::disk('public')->exists($this->post->image_path)) {
                Storage::disk('public')->delete($this->post->image_path);
            }
            $data['image_path'] = $this->image->store('posts', 'public');
        }

        $this->post->update($data);

        // Clear cache so updated posts appear immediately on public pages and dashboard
        Cache::forget('blog.total_posts');
        Cache::forget('admin.dashboard.stats');
        public_cache_forget('home.latest_posts');
        public_cache_forget('home.total_posts');

        session()->flash('success', 'Artikel berhasil diperbarui!');

        return redirect()->route('admin.posts.index');
    }

    public function render()
    {
        return view('livewire.admin.posts.edit', [
            'categories' => PostCategory::all(),
        ])->layoutData([
            'title' => 'Edit Postingan - Admin Dashboard',
        ]);
    }
}
