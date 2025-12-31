<div x-data="{ 
    open: false,
    toggle() {
        if (this.open) {
            this.close();
        } else {
            this.open = true;
            this.$nextTick(() => $refs.searchInput.focus());
        }
    },
    close() {
        this.open = false;
        $wire.set('search', '');
    }
}"
@keydown.window.prevent.ctrl.k="toggle()"
@keydown.window.prevent.cmd.k="toggle()"
@keydown.escape.window="close()"
class="relative z-[100]"
style="display: none;"
x-show="open"
x-cloak>

    {{-- Backdrop --}}
    <div class="fixed inset-0 bg-black/40 backdrop-blur-sm transition-opacity" 
         x-show="open"
         x-transition:enter="ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="close()"></div>

    {{-- Modal --}}
    <div class="fixed inset-0 z-[100] overflow-y-auto p-4 sm:p-6 md:p-20">
        <div class="mx-auto max-w-2xl transform divide-y divide-border overflow-hidden rounded-2xl bg-surface shadow-2xl ring-1 ring-black/5 transition-all"
             x-show="open"
             x-transition:enter="ease-out duration-300"
             x-transition:enter-start="opacity-0 scale-95"
             x-transition:enter-end="opacity-100 scale-100"
             x-transition:leave="ease-in duration-200"
             x-transition:leave-start="opacity-100 scale-100"
             x-transition:leave-end="opacity-0 scale-95"
             @click.away="close()">
            
            <div class="relative">
                <svg class="pointer-events-none absolute left-4 top-3.5 h-5 w-5 text-text-muted" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
                </svg>
                <input type="text" 
                       x-ref="searchInput"
                       wire:model.live.debounce.300ms="search"
                       class="h-12 w-full border-0 bg-transparent pl-11 pr-4 text-text-main placeholder:text-text-muted focus:ring-0 sm:text-sm" 
                       placeholder="Cari event, artikel, atau halaman..." 
                       role="combobox" 
                       aria-expanded="false" 
                       aria-controls="options">
            </div>

            @if(count($results) > 0)
                <ul class="max-h-96 scroll-py-3 overflow-y-auto p-3" id="options" role="listbox">
                    @foreach($results as $result)
                        <li class="group flex cursor-pointer select-none rounded-xl p-3 hover:bg-surface-secondary" 
                            id="option-{{ $loop->index }}" 
                            role="option" 
                            tabindex="-1"
                            wire:click="close"
                            onclick="window.location.href='{{ $result['url'] }}'">
                            <div class="flex h-10 w-10 flex-none items-center justify-center rounded-lg {{ $result['type'] === 'Event' ? 'bg-primary-50 text-primary-600' : 'bg-blue-50 text-blue-600' }}">
                                @if($result['type'] === 'Event')
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                                    </svg>
                                @else
                                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                                    </svg>
                                @endif
                            </div>
                            <div class="ml-4 flex-auto">
                                <p class="text-sm font-medium text-text-main group-hover:text-primary-600">{{ $result['title'] }}</p>
                                <p class="text-sm text-text-muted">{{ $result['type'] }} • {{ $result['date'] }}</p>
                            </div>
                            <div class="ml-3 flex-none items-center justify-center hidden group-hover:flex">
                                <svg class="h-5 w-5 text-text-muted" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                                    <path fill-rule="evenodd" d="M7.21 14.77a.75.75 0 01.02-1.06L11.168 10 7.23 6.29a.75.75 0 111.04-1.08l4.5 4.25a.75.75 0 010 1.08l-4.5 4.25a.75.75 0 01-1.06-.02z" clip-rule="evenodd" />
                                </svg>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @elseif(strlen($search) >= 2)
                <div class="px-6 py-14 text-center text-sm sm:px-14">
                    <svg class="mx-auto h-6 w-6 text-text-muted" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m9-.75a9 9 0 11-18 0 9 9 0 0118 0zm-9 3.75h.008v.008H12v-.008z" />
                    </svg>
                    <p class="mt-4 font-semibold text-text-main">Tidak ada hasil ditemukan</p>
                    <p class="mt-2 text-text-muted">Kami tidak dapat menemukan apa pun dengan istilah pencarian tersebut. Silakan coba lagi.</p>
                </div>
            @else
                <div class="px-6 py-14 text-center text-sm sm:px-14">
                    <div class="flex justify-center items-center gap-2 text-text-muted mb-4">
                        <kbd class="hidden sm:inline-block rounded border border-border bg-surface-secondary px-2 py-0.5 text-xs font-light text-text-muted">Ctrl</kbd>
                        <span class="hidden sm:inline-block">+</span>
                        <kbd class="hidden sm:inline-block rounded border border-border bg-surface-secondary px-2 py-0.5 text-xs font-light text-text-muted">K</kbd>
                    </div>
                    <p class="text-text-muted">Ketik untuk mulai mencari...</p>
                </div>
            @endif
        </div>
    </div>
</div>
