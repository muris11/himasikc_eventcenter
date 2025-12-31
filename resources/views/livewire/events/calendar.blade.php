<div class="py-12 bg-background min-h-screen">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-12 relative">
            <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 w-64 h-64 bg-primary-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <h1 class="text-3xl md:text-4xl font-bold text-text-main font-heading mb-6 relative z-10">Kalender Event</h1>
            
            <div class="flex items-center justify-center space-x-6 bg-surface inline-flex px-6 py-2.5 rounded-full shadow-sm border border-border relative z-10">
                <button wire:click="previousMonth" class="p-2 rounded-full hover:bg-surface-secondary text-text-muted hover:text-primary-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                </button>
                <h2 class="text-xl font-bold text-text-main min-w-[180px] font-heading tracking-wide">{{ $currentDate->format('F Y') }}</h2>
                <button wire:click="nextMonth" class="p-2 rounded-full hover:bg-surface-secondary text-text-muted hover:text-primary-600 transition-colors">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                    </svg>
                </button>
            </div>
        </div>

        <div class="bg-surface rounded-[2rem] border border-border overflow-hidden shadow-lg shadow-primary-500/5">
            <!-- Days Header -->
            <div class="grid grid-cols-7 bg-surface-secondary border-b border-border">
                @foreach(['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'] as $day)
                    <div class="py-4 text-center text-sm font-bold text-text-muted uppercase tracking-wider">
                        {{ $day }}
                    </div>
                @endforeach
            </div>

            <!-- Calendar Grid -->
            <div class="grid grid-cols-7 auto-rows-fr bg-surface">
                <!-- Empty cells for previous month -->
                @for($i = 0; $i < $firstDayOfWeek; $i++)
                    <div class="min-h-[140px] border-b border-r border-border bg-surface-secondary/30"></div>
                @endfor

                <!-- Days of current month -->
                @for($day = 1; $day <= $daysInMonth; $day++)
                    @php
                        $dateStr = sprintf('%04d-%02d-%02d', $year, $month, $day);
                        $dayEvents = $events->filter(function($event) use ($dateStr) {
                            return $event->date->format('Y-m-d') === $dateStr;
                        });
                        $isToday = $day === now()->day && $month === now()->month && $year === now()->year;
                    @endphp
                    <div class="min-h-[140px] border-b border-r border-border p-3 relative group hover:bg-surface-secondary/50 transition-colors {{ $isToday ? 'bg-primary-50/30' : '' }}">
                        <span class="text-sm font-bold inline-flex items-center justify-center w-8 h-8 rounded-full {{ $isToday ? 'bg-primary-500 text-white shadow-md' : 'text-text-muted group-hover:text-text-main' }}">
                            {{ $day }}
                        </span>
                        
                        <div class="mt-3 space-y-1.5 overflow-y-auto max-h-[90px] scrollbar-hide">
                            @foreach($dayEvents as $event)
                                <a href="{{ route('events.show', $event->slug) }}" class="block px-2.5 py-1.5 text-xs font-bold bg-primary-50 text-primary-700 rounded-lg hover:bg-primary-100 hover:text-primary-800 truncate transition-all shadow-sm border border-primary-100/50" title="{{ $event->title }}">
                                    {{ $event->title }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endfor

                <!-- Empty cells for next month to fill grid -->
                @php
                    $remainingCells = 7 - (($firstDayOfWeek + $daysInMonth) % 7);
                    if ($remainingCells == 7) $remainingCells = 0;
                @endphp
                @for($i = 0; $i < $remainingCells; $i++)
                    <div class="min-h-[140px] border-b border-r border-border bg-surface-secondary/30"></div>
                @endfor
            </div>
        </div>
    </div>
</div>
