<?php

namespace App\Livewire\Admin\Milestones;

use App\Models\Milestone;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Edit extends Component
{
    public Milestone $milestone;
    public $year;
    public $title;
    public $description;

    protected $rules = [
        'year' => 'required|numeric|digits:4',
        'title' => 'required|string|max:255',
        'description' => 'required|string',
    ];

    public function mount(Milestone $milestone)
    {
        $this->milestone = $milestone;
        $this->year = $milestone->year;
        $this->title = $milestone->title;
        $this->description = $milestone->description;
    }

    public function update()
    {
        $this->validate();

        $this->milestone->update([
            'year' => $this->year,
            'title' => $this->title,
            'description' => $this->description,
        ]);

        session()->flash('success', 'Milestone berhasil diperbarui!');

        return redirect()->route('admin.milestones.index');
    }

    public function render()
    {
        return view('livewire.admin.milestones.edit')->layoutData([
            'title' => 'Edit Milestone - Admin Dashboard',
        ]);
    }
}
