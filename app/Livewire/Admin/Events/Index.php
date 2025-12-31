<?php

namespace App\Livewire\Admin\Events;

use App\Models\Event;
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

    public function delete($eventId)
    {
        $event = Event::findOrFail($eventId);
        $event->delete();

        // Clear cache agar data langsung update di halaman publik dan dashboard
        Cache::forget('events.total_active');
        Cache::forget('admin.dashboard.stats');
        public_cache_forget('home.featured_events');
        public_cache_forget('home.total_events');

        session()->flash('success', 'Event berhasil dihapus!');
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
        $query = Event::query();

        // Search functionality
        if ($this->search) {
            $query->where(function ($q) {
                $q->where('title', 'like', '%'.$this->search.'%')
                    ->orWhere('description', 'like', '%'.$this->search.'%')
                    ->orWhere('location', 'like', '%'.$this->search.'%');
            });
        }

        // Status filter
        if ($this->statusFilter !== '') {
            $query->where('is_active', $this->statusFilter === 'active');
        }

        return view('livewire.admin.events.index', [
            'events' => $query->with('category')->latest()->paginate($this->perPage),
        ])->layoutData([
            'title' => 'Kelola Event - Admin Dashboard',
        ]);
    }
}
