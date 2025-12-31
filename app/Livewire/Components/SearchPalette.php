<?php

namespace App\Livewire\Components;

use Livewire\Component;
use App\Models\Event;
use App\Models\Post;

class SearchPalette extends Component
{
    public $search = '';
    public $results = [];

    public function updatedSearch()
    {
        if (strlen($this->search) < 2) {
            $this->results = [];
            return;
        }

        $events = Event::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('description', 'like', '%' . $this->search . '%')
            ->take(5)
            ->get()
            ->map(function ($event) {
                return [
                    'id' => $event->id,
                    'title' => $event->title,
                    'type' => 'Event',
                    'url' => route('events.show', $event->slug),
                    'date' => $event->date->format('d M Y'),
                ];
            });

        $posts = Post::where('title', 'like', '%' . $this->search . '%')
            ->orWhere('content', 'like', '%' . $this->search . '%')
            ->take(5)
            ->get()
            ->map(function ($post) {
                return [
                    'id' => $post->id,
                    'title' => $post->title,
                    'type' => 'Artikel',
                    'url' => route('blog.show', $post->slug),
                    'date' => $post->created_at->format('d M Y'),
                ];
            });

        $this->results = $events->concat($posts);
    }

    public function render()
    {
        return view('livewire.components.search-palette');
    }
}
