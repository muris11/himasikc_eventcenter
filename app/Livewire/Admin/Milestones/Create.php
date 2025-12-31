<?php

namespace App\Livewire\Admin\Milestones;

use App\Models\Milestone;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Create extends Component
{
    public $year;
    public $title;
    public $description;

    protected $rules = [
        'year' => 'required|numeric|digits:4',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        Milestone::create([
            'year' => $this->year,
            'title' => $this->title,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Milestone berhasil ditambahkan!');

        return redirect()->route('admin.milestones.index');
    }

    public function render()
    {
        return view('livewire.admin.milestones.create')->layoutData([
            'title' => 'Tambah Milestone - Admin Dashboard',
        ]);
    }
}
