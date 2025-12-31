<?php

namespace App\Livewire\Admin\Milestones;

use App\Models\Milestone;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.admin')]
class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $perPage = 10;

    public function delete($id)
    {
        $milestone = Milestone::findOrFail($id);
        $milestone->delete();

        session()->flash('success', 'Milestone berhasil dihapus!');
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = Milestone::query();

        if ($this->search) {
            $query->where('title', 'like', '%'.$this->search.'%')
                ->orWhere('year', 'like', '%'.$this->search.'%')
                ->orWhere('description', 'like', '%'.$this->search.'%');
        }

        return view('livewire.admin.milestones.index', [
            'milestones' => $query->orderBy('year', 'desc')->paginate($this->perPage),
        ])->layoutData([
            'title' => 'Kelola Milestone - Admin Dashboard',
        ]);
    }
}
