<?php

namespace App\Livewire\Events;

use App\Models\Event;
use Carbon\Carbon;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Calendar extends Component
{
    public $year;

    public $month;

    public function mount()
    {
        $this->year = now()->year;
        $this->month = now()->month;
    }

    public function nextMonth()
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1)->addMonth();
        $this->year = $date->year;
        $this->month = $date->month;
    }

    public function previousMonth()
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1)->subMonth();
        $this->year = $date->year;
        $this->month = $date->month;
    }

    public function getEventsProperty()
    {
        return Event::where('is_active', true)
            ->whereYear('date', $this->year)
            ->whereMonth('date', $this->month)
            ->get();
    }

    public function render()
    {
        $date = Carbon::createFromDate($this->year, $this->month, 1);
        $daysInMonth = $date->daysInMonth;
        $firstDayOfWeek = $date->dayOfWeek; // 0 (Sunday) to 6 (Saturday)

        return view('livewire.events.calendar', [
            'currentDate' => $date,
            'daysInMonth' => $daysInMonth,
            'firstDayOfWeek' => $firstDayOfWeek,
            'events' => $this->events,
        ])->layoutData([
            'title' => 'Kalender Event | HIMA-SIKC Event Center',
            'description' => 'Lihat jadwal event dan kompetisi di HIMA-SIKC Event Center dalam format kalender. Jangan lewatkan event penting!',
            'keywords' => 'kalender event, jadwal lomba, jadwal kompetisi, HIMA-SIKC Event Center',
            'canonical' => route('events.calendar'),
        ]);
    }
}
