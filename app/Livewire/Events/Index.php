<?php

namespace App\Livewire\Events;

use App\Models\Event;
use App\Models\EventCategory;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    #[Url(as: 'q')]
    public $search = '';

    #[Url(as: 'category')]
    public $selectedCategory = '';

    #[Url(as: 'status')]
    public $selectedStatus = 'all'; // all, active, inactive

    #[Url(as: 'view')]
    public $viewMode = 'grid'; // grid, list

    public $perPage = 9;

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingSelectedCategory()
    {
        $this->resetPage();
    }

    public function updatingSelectedStatus()
    {
        $this->resetPage();
    }

    public function clearFilters()
    {
        $this->reset(['search', 'selectedCategory', 'selectedStatus']);
        $this->resetPage();
    }

    public function render()
    {
        $title = 'Daftar Event & Kompetisi | HIMA-SIKC Event Center';
        $description = 'Temukan berbagai event, kompetisi, dan lomba mahasiswa di HIMA-SIKC Event Center. Seminar, workshop, lomba programming, hackathon, dan kegiatan menarik lainnya.';
        $keywords = 'event HIMA SIKC, kompetisi mahasiswa, lomba programming, hackathon, seminar teknologi, workshop, politeknik indramayu, HIMA-SIKC Event Center';
        $canonical = route('events.index');

        $categories = Cache::remember('event_categories.all', 600, function () {
            return EventCategory::select(['id', 'name'])
                ->orderBy('name')
                ->get();
        });

        $query = Event::query()
            ->select(['id', 'title', 'description', 'date', 'location', 'image_path', 'is_active', 'participant_type', 'event_category_id', 'slug'])
            ->with(['category:id,name']);

        // Search
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%')
                    ->orWhere('location', 'like', '%'.$this->search.'%');
            });
        }

        // Category filter
        if ($this->selectedCategory) {
            $query->where('event_category_id', $this->selectedCategory);
        }

        // Status filter
        if ($this->selectedStatus === 'active') {
            $query->where('is_active', true);
        } elseif ($this->selectedStatus === 'inactive') {
            $query->where('is_active', false);
        }

        $events = $query->orderBy('date', 'desc')->paginate($this->perPage);

        $totalEvents = Cache::remember('events.total_active', 600, function () {
            return Event::where('is_active', true)->count();
        });

        return view('livewire.events.index', [
            'events' => $events,
            'categories' => $categories,
            'totalEvents' => $totalEvents,
        ])->layoutData([
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'canonical' => $canonical,
            'structuredData' => '<script type="application/ld+json">'.json_encode([
                '@context' => 'https://schema.org',
                '@type' => 'ItemList',
                'name' => 'Daftar Event HIMA SIKC',
                'description' => $description,
                'url' => $canonical,
                'numberOfItems' => $totalEvents,
            ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE).'</script>',
        ]);
    }
}
