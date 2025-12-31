@props(['value' => ''])

<div class="col-span-2" wire:ignore>
    <label class="block text-sm font-bold text-text-main mb-3">
        Deskripsi / Konten
        <span class="text-xs font-normal text-text-muted ml-2">Gunakan toolbar untuk formatting</span>
    </label>

    <!-- Rich Text Editor Container -->
    <div class="border border-border rounded-2xl overflow-hidden bg-surface shadow-sm focus-within:ring-2 focus-within:ring-primary-500 focus-within:border-primary-500 transition-all">

        <!-- Custom Toolbar -->
        <div class="flex flex-wrap items-center gap-1 p-3 bg-surface-secondary border-b border-border">
            <!-- Text Formatting -->
            <div class="flex items-center gap-1 pr-3 border-r border-border">
                <button type="button" data-command="bold" title="Bold (Ctrl+B)"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="3" viewBox="0 0 24 24">
                        <path d="M6 4h8a4 4 0 014 4 4 4 0 01-4 4H6z"/><path d="M6 12h9a4 4 0 014 4 4 4 0 01-4 4H6z"/>
                    </svg>
                </button>
                <button type="button" data-command="italic" title="Italic (Ctrl+I)"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M19 4h-9M14 20H5M15 4L9 20"/>
                    </svg>
                </button>
                <button type="button" data-command="underline" title="Underline (Ctrl+U)"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 3v7a6 6 0 006 6 6 6 0 006-6V3M4 21h16"/>
                    </svg>
                </button>
            </div>

            <!-- Headings -->
            <div class="flex items-center gap-1 px-3 border-r border-border">
                <select data-command="formatBlock"
                        class="text-sm bg-transparent border-0 text-text-muted focus:ring-0 cursor-pointer hover:text-text-main font-medium">
                    <option value="p">Paragraph</option>
                    <option value="h2">Heading 2</option>
                    <option value="h3">Heading 3</option>
                    <option value="h4">Heading 4</option>
                </select>
            </div>

            <!-- Lists -->
            <div class="flex items-center gap-1 px-3 border-r border-border">
                <button type="button" data-command="insertUnorderedList" title="Bullet List"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M8 6h13M8 12h13M8 18h13M3 6h.01M3 12h.01M3 18h.01"/>
                    </svg>
                </button>
                <button type="button" data-command="insertOrderedList" title="Numbered List"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M10 6h11M10 12h11M10 18h11M4 6h1v4M4 10h2M6 18H4c0-.55.22-1.05.58-1.41L6 15h-2"/>
                    </svg>
                </button>
            </div>

            <!-- Links & Media -->
            <div class="flex items-center gap-1 px-3">
                <button type="button" data-command="createLink" title="Insert Link"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M10 13a5 5 0 007.54.54l3-3a5 5 0 00-7.07-7.07l-1.72 1.71"/>
                        <path d="M14 11a5 5 0 00-7.54-.54l-3 3a5 5 0 007.07 7.07l1.71-1.71"/>
                    </svg>
                </button>
                <button type="button" data-command="insertImage" title="Insert Image"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <path d="M21 15l-5-5L5 21"/>
                    </svg>
                </button>
            </div>

            <!-- Alignment -->
            <div class="flex items-center gap-1 pl-3 border-l border-border">
                <button type="button" data-command="justifyLeft" title="Align Left"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17 10H3M21 6H3M21 14H3M17 18H3"/>
                    </svg>
                </button>
                <button type="button" data-command="justifyCenter" title="Align Center"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M18 10H6M21 6H3M21 14H3M18 18H6"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Editor Area -->
        <div id="editor-content-{{ $attributes->wire('model')->value() }}"
             contenteditable="true"
             class="min-h-[300px] sm:min-h-[400px] p-4 sm:p-6
                    prose prose-sm sm:prose-base max-w-none
                    prose-headings:font-heading prose-headings:text-text-main
                    prose-p:text-text-muted prose-p:leading-relaxed
                    prose-a:text-primary-600 prose-a:no-underline hover:prose-a:underline
                    prose-ul:list-disc prose-ol:list-decimal
                    prose-img:rounded-xl prose-img:shadow-md
                    focus:outline-none"
             data-placeholder="Mulai menulis deskripsi event atau konten blog di sini...">
            {!! $value !!}
        </div>

        <!-- Hidden input for Livewire -->
        <input type="hidden" {{ $attributes->wire('model') }} id="hidden-input-{{ $attributes->wire('model')->value() }}">
    </div>

    <!-- Helper text -->
    <p class="mt-2 text-xs text-text-muted flex items-center gap-1.5">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        Gunakan Ctrl+B untuk bold, Ctrl+I untuk italic. Hasil akan tampil sesuai formatting di halaman publik.
    </p>

    @error($attributes->wire('model')->value())
        <p class="mt-2 text-sm text-red-500 flex items-center">{{ $message }}</p>
    @enderror
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const editorId = 'editor-content-{{ $attributes->wire('model')->value() }}';
    const inputId = 'hidden-input-{{ $attributes->wire('model')->value() }}';
    
    const editor = document.getElementById(editorId);
    const hiddenInput = document.getElementById(inputId);

    if (!editor || !hiddenInput) return;

    // Sync content to Livewire
    editor.addEventListener('input', function() {
        hiddenInput.value = editor.innerHTML;
        hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
    });

    // Toolbar commands
    const toolbar = editor.closest('.border').querySelector('.flex-wrap');
    if (toolbar) {
        toolbar.querySelectorAll('[data-command]').forEach(btn => {
            btn.addEventListener('click', function() {
                const command = this.dataset.command;

                if (command === 'createLink') {
                    const url = prompt('Masukkan URL:');
                    if (url) document.execCommand(command, false, url);
                } else if (command === 'formatBlock') {
                    // This is handled by the select change event usually, but if it's a button?
                    // The user code used a select for formatBlock.
                } else if (command === 'insertImage') {
                     const url = prompt('Masukkan URL Gambar:');
                     if (url) document.execCommand(command, false, url);
                } else {
                    document.execCommand(command, false, null);
                }

                editor.focus();
            });
        });

        // Handle select for formatBlock
        const formatSelect = toolbar.querySelector('select[data-command="formatBlock"]');
        if (formatSelect) {
            formatSelect.addEventListener('change', function() {
                document.execCommand('formatBlock', false, `<${this.value}>`);
                editor.focus();
                this.selectedIndex = 0; // Reset selection
            });
        }
    }

    // Placeholder behavior (optional, CSS can handle empty state too)
    editor.addEventListener('focus', function() {
        if (this.innerHTML === '' || this.innerHTML === '<br>') {
            // this.innerHTML = '';
        }
    });
});
</script>
