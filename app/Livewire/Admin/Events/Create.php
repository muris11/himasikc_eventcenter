<?php

namespace App\Livewire\Admin\Events;

use App\Models\Event;
use App\Models\EventCategory;
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

    public $description;

    public $date;

    public $location;

    public $registration_link;

    public $is_active = true;

    public $participant_type = 'all';

    public $category_id;

    public $image;

    public $organizer;

    protected $rules = [
        'title' => 'required|min:3',
        'description' => 'required',
        'date' => 'required|date',
        'location' => 'required',
        'registration_link' => 'nullable|url',
        'is_active' => 'boolean',
        'participant_type' => 'required|in:all,mahasiswa,umum',
        'category_id' => 'required|exists:event_categories,id',
        'image' => 'nullable|image|max:2048',
        'organizer' => 'nullable|string|max:255',
    ];

    public function updatedTitle()
    {
        $this->slug = Str::slug($this->title);
    }

    public function save()
    {
        $this->validate();

        // Generate unique slug
        $baseSlug = Str::slug($this->title);
        $slug = $baseSlug;
        $counter = 1;

        while (Event::where('slug', $slug)->exists()) {
            $slug = $baseSlug.'-'.$counter;
            $counter++;
        }

        $data = [
            'title' => $this->title,
            'slug' => $slug,
            'description' => $this->description,
            'date' => $this->date,
            'location' => $this->location,
            'organizer' => $this->organizer,
            'registration_link' => $this->registration_link,
            'is_active' => $this->is_active,
            'event_category_id' => $this->category_id,
            'participant_type' => $this->participant_type,
        ];

        if ($this->image) {
            $data['image_path'] = $this->image->store('events', 'public');
        }

        Event::create($data);

        // Clear cache agar data langsung muncul di halaman publik dan dashboard
        Cache::forget('events.total_active');
        Cache::forget('admin.dashboard.stats');
        public_cache_forget('home.featured_events');
        public_cache_forget('home.total_events');

        session()->flash('success', 'Event berhasil dibuat!');

        return redirect()->route('admin.events.index');
    }

    public function render()
    {
        return view('livewire.admin.events.create', [
            'categories' => EventCategory::all(),
        ])->layoutData([
            'title' => 'Buat Event Baru - Admin Dashboard',
        ]);
    }
}
