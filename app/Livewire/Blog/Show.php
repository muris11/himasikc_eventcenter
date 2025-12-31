<?php

namespace App\Livewire\Blog;

use App\Models\Event;
use App\Models\Post;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Show extends Component
{
    public Post $post;

    public $latestPosts;

    public $relatedPosts;

    public $latestEvents;

    public $pageTitle;

    public $title;

    public function mount(Post $post)
    {
        // Only show public posts (unless an admin user is previewing)
        if (! $post->is_published) {
            if (! auth()->check() || auth()->user()->role !== 'admin') {
                abort(404);
            }
        }
        $this->post = $post->load('category', 'user', 'images');
        $this->pageTitle = $post->title.' - Blog HIMA-SIKC Event Center';
        $this->title = $this->pageTitle;
        $this->loadSidebarData();
    }

    public function loadSidebarData()
    {
        // Latest posts (exclude current post, only published)
        $this->latestPosts = Post::with(['user', 'category'])
            ->where('is_published', true)
            ->where('id', '!=', $this->post->id)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        // Related posts (same category, exclude current post, only published)
        if ($this->post->category) {
            $this->relatedPosts = Post::with(['user', 'category'])
                ->where('post_category_id', $this->post->category->id)
                ->where('is_published', true)
                ->where('id', '!=', $this->post->id)
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();
        } else {
            $this->relatedPosts = collect(); // Empty collection if no category
        }

        // Latest events (only active)
        $this->latestEvents = Event::with('category')
            ->where('is_active', true)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();
    }

    public function render()
    {
        $title = $this->post->title.' - '.config('app.name');
        $description = Str::limit(strip_tags((string) $this->post->content), 160);
        $keywords = implode(', ', array_filter([
            'blog HIMA SIKC',
            $this->post->title,
            optional($this->post->category)->name,
        ]));
        $ogImage = $this->post->image_path
          ? asset('storage/'.$this->post->image_path)
          : asset('images/og-default.jpg');

        $canonical = route('blog.show', $this->post->slug);
        $structuredData = '<script type="application/ld+json">'.json_encode(
            \App\Helpers\SeoHelper::generateBlogStructuredData($this->post),
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        ).'</script>';

        return view('livewire.blog.show')->layoutData([
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'og_image' => $ogImage,
            'canonical' => $canonical,
            'structuredData' => $structuredData,
        ]);
    }
}
