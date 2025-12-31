<?php

namespace App\Livewire\Admin\Hero;

use App\Models\HeroSection;
use function App\Providers\public_cache_forget;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithFileUploads;

    public $heroSection;
    public $image;
    public $title;
    public $subtitle;
    public $link;

    protected $rules = [
        'image' => 'nullable|image|max:2048', // 2MB Max
        'title' => 'nullable|string|max:255',
        'subtitle' => 'nullable|string|max:255',
        'link' => 'nullable|url|max:255',
    ];

    public function mount()
    {
        $this->heroSection = HeroSection::first();

        if ($this->heroSection) {
            $this->title = $this->heroSection->title;
            $this->subtitle = $this->heroSection->subtitle;
            $this->link = $this->heroSection->link;
        }
    }

    public function save()
    {
        $this->validate();

        $data = [
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            'link' => $this->link,
        ];

        if ($this->image) {
            // Delete old image if exists
            if ($this->heroSection && $this->heroSection->image_path) {
                if (Storage::disk('public')->exists($this->heroSection->image_path)) {
                    Storage::disk('public')->delete($this->heroSection->image_path);
                }
            }
            
            $data['image_path'] = $this->image->store('hero', 'public');
        }

        if ($this->heroSection) {
            $this->heroSection->update($data);
        } else {
            // Require image for first creation if not present
            if (!$this->image) {
                $this->addError('image', 'Gambar wajib diunggah untuk pertama kali.');
                return;
            }
            HeroSection::create($data);
        }

        session()->flash('success', 'Hero section berhasil diperbarui!');

        public_cache_forget('home.hero_section');
        
        // Reset image input
        $this->image = null;
        $this->heroSection = HeroSection::first(); // Refresh
    }

    public function render()
    {
        return view('livewire.admin.hero.index')->layoutData([
            'title' => 'Kelola Hero Section - Admin Dashboard',
        ]);
    }
}
