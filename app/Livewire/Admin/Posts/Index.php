<?php

namespace App\Livewire\Admin\Posts;

use App\Models\Post;
use function App\Providers\public_cache_forget;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $search = '';

    public $statusFilter = '';

    public $perPage = 10;

    public function delete($postId)
    {
        $post = Post::findOrFail($postId);
        $post->delete();

        // Clear cache so deleted posts no longer appear on public pages and dashboard
        Cache::forget('blog.total_posts');
        Cache::forget('admin.dashboard.stats');
        public_cache_forget('home.latest_posts');
        public_cache_forget('home.total_posts');

        session()->flash('success', 'Postingan berhasil dihapus!');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingStatusFilter()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Post::query();

        // Search functionality
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('content', 'like', '%'.$this->search.'%');
            });
        }

        // Status filter
        if ($this->statusFilter !== '') {
            $query->where('is_published', $this->statusFilter === 'published');
        }

        return view('livewire.admin.posts.index', [
            'posts' => $query->with(['user', 'category'])->latest()->paginate($this->perPage),
        ])->layoutData([
            'title' => 'Kelola Postingan - Admin Dashboard',
        ]);
    }
}
