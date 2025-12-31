<?php

namespace App\Livewire\Events;

use App\Models\Event;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Show extends Component
{
    public Event $event;

    public $latestEvents;

    public $latestPosts;

    public $relatedEvents;

    public $pageTitle;

    public $title;

    public function mount(Event $event)
    {
        // Only show active events to the public; allow admins to preview inactive events
        if (! $event->is_active) {
            if (! Auth::check() || Auth::user()->role !== 'admin') {
                abort(404);
            }
        }

        $this->event = $event->load('category', 'images');
        $this->pageTitle = $event->title.' - HIMA-SIKC Event Center';
        $this->title = $this->pageTitle;
        $this->loadSidebarData();
    }

    public function loadSidebarData()
    {
        // Latest events (exclude current event, only active)
        $this->latestEvents = Event::with('category')
            ->where('is_active', true)
            ->where('id', '!=', $this->event->id)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        // Latest posts (only published)
        $this->latestPosts = Post::with(['user', 'category'])
            ->where('is_published', true)
            ->orderBy('id', 'desc')
            ->take(5)
            ->get();

        // Load related events after sidebar data
        $this->loadRelatedEvents();
    }

    // Related events (same category, exclude current event)
    protected function loadRelatedEvents()
    {
        if ($this->event->category) {
            $this->relatedEvents = Event::with('category')
                ->where('is_active', true)
                ->where('event_category_id', $this->event->category->id)
                ->where('id', '!=', $this->event->id)
                ->orderBy('id', 'desc')
                ->take(5)
                ->get();
        } else {
            $this->relatedEvents = collect();
        }
    }

    public function render()
    {
        $title = $this->event->title.' - '.config('app.name');
        $description = Str::limit(strip_tags((string) $this->event->description), 160);
        $keywords = implode(', ', array_filter([
            'event HIMA SIKC',
            $this->event->title,
            optional($this->event->category)->name,
            $this->event->location,
        ]));
        $ogImage = $this->event->image_path
            ? asset('storage/'.$this->event->image_path)
            : asset('images/og-default.jpg');

        $canonical = route('events.show', $this->event->slug);

        $structuredData = '<script type="application/ld+json">'.json_encode(
            \App\Helpers\SeoHelper::generateEventStructuredData($this->event),
            JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE
        ).'</script>';

        return view('livewire.events.show')->layoutData([
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'og_image' => $ogImage,
            'canonical' => $canonical,
            'structuredData' => $structuredData,
        ]);
    }
}
