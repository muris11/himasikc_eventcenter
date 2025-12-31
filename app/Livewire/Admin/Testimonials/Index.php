<?php

namespace App\Livewire\Admin\Testimonials;

use App\Models\Testimonial;
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

    public function delete($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();

        public_cache_forget('home.testimonials');

        session()->flash('success', 'Testimoni berhasil dihapus!');
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
        $query = Testimonial::query();

        if ($this->search) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('role', 'like', '%' . $this->search . '%')
                  ->orWhere('content', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->statusFilter !== '') {
            $query->where('is_active', $this->statusFilter === 'active');
        }

        return view('livewire.admin.testimonials.index', [
            'testimonials' => $query->latest()->paginate($this->perPage),
        ])->layoutData([
            'title' => 'Kelola Testimoni - Admin Dashboard',
        ]);
    }
}
