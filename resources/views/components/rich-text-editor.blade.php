@props(['value' => ''])

<div class="col-span-2" wire:ignore x-data="{ fullscreen: false, charCount: 0, wordCount: 0 }">
    <div class="flex items-center justify-between mb-3">
        <label class="block text-sm font-bold text-text-main">
        Deskripsi / Konten
        <span class="text-xs font-normal text-text-muted ml-2">Gunakan toolbar untuk formatting</span>
    </label>
        
        <!-- Stats -->
        <div class="flex items-center gap-4 text-xs text-text-muted">
            <span><strong x-text="wordCount"></strong> kata</span>
            <span><strong x-text="charCount"></strong> karakter</span>
        </div>
    </div>

    <!-- Rich Text Editor Container -->
    <div class="border border-border rounded-2xl overflow-hidden bg-surface shadow-sm focus-within:ring-2 focus-within:ring-primary-500 focus-within:border-primary-500 transition-all"
         :class="{ 'fixed inset-4 z-50 rounded-2xl': fullscreen }">

        <!-- Custom Toolbar -->
        <div class="flex flex-wrap items-center gap-1 p-3 bg-surface-secondary border-b border-border sticky top-0 z-10">
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
                <button type="button" data-command="strikeThrough" title="Strikethrough"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M17.3 10c.4-.8.7-1.7.7-2.7 0-2.8-2.2-5-5-5-2 0-3.7 1.2-4.5 2.9M4 12h16M8 18c.8 1.2 2.2 2 3.8 2 2.8 0 5-2.2 5-5 0-1.5-.6-2.8-1.5-3.8"/>
                    </svg>
                </button>
            </div>

            <!-- Headings -->
            <div class="flex items-center gap-1 px-3 border-r border-border">
                <select data-command="formatBlock"
                        class="text-sm bg-transparent border-0 text-text-muted focus:ring-0 cursor-pointer hover:text-text-main font-medium">
                    <option value="p">Paragraph</option>
                    <option value="h1">Heading 1</option>
                    <option value="h2">Heading 2</option>
                    <option value="h3">Heading 3</option>
                    <option value="h4">Heading 4</option>
                    <option value="h5">Heading 5</option>
                    <option value="h6">Heading 6</option>
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

            <!-- Block Elements -->
            <div class="flex items-center gap-1 px-3 border-r border-border">
                <button type="button" data-command="formatBlock" data-value="blockquote" title="Quote"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 21c3 0 7-1 7-8V5c0-1.25-.756-2.017-2-2H4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2 1 0 1 0 1 1v1c0 1-1 2-2 2M15 21c3 0 7-1 7-8V5c0-1.25-.757-2.017-2-2h-4c-1.25 0-2 .75-2 1.972V11c0 1.25.75 2 2 2h.75c0 2.25.25 4-2.75 4v3z"/>
                    </svg>
                </button>
                <button type="button" data-command="insertHorizontalRule" title="Horizontal Line"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M5 12h14"/>
                    </svg>
                </button>
                <button type="button" data-command="insertCode" title="Code Block"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M16 18l6-6-6-6M8 6l-6 6 6 6"/>
                    </svg>
                </button>
            </div>

            <!-- Indent & More -->
            <div class="flex items-center gap-1 px-3 border-l border-border">
                <button type="button" data-command="indent" title="Indent"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h8M4 18h8M14 12l4 4m0-8l-4 4"/>
                    </svg>
                </button>
                <button type="button" data-command="outdent" title="Outdent"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h8M4 18h8M18 12l-4-4m0 8l4-4"/>
                    </svg>
                </button>
                <button type="button" data-command="superscript" title="Superscript"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <text x="2" y="18" font-size="14" font-weight="bold">X</text>
                        <text x="12" y="8" font-size="8">2</text>
                    </svg>
                </button>
                <button type="button" data-command="subscript" title="Subscript"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <text x="2" y="14" font-size="14" font-weight="bold">X</text>
                        <text x="12" y="20" font-size="8">2</text>
                    </svg>
                </button>
            </div>

            <!-- Links & Media -->
            <div class="flex items-center gap-1 px-3 border-r border-border">
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
                <button type="button" data-command="justifyRight" title="Align Right"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 10H7M21 6H3M21 14H3M21 18H7"/>
                    </svg>
                </button>
                <button type="button" data-command="justifyFull" title="Justify"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 10H3M21 6H3M21 14H3M21 18H3"/>
                    </svg>
                </button>
            </div>

            <!-- Colors -->
            <div class="flex items-center gap-1 px-3 border-l border-border">
                <div class="relative">
                    <input type="color" data-command="foreColor" title="Text Color"
                           class="w-8 h-8 rounded cursor-pointer border-0">
                </div>
                <div class="relative">
                    <input type="color" data-command="hiliteColor" title="Background Color"
                           class="w-8 h-8 rounded cursor-pointer border-0">
                </div>
            </div>

            <!-- History & Clear -->
            <div class="flex items-center gap-1 px-3 border-l border-border">
                <button type="button" data-command="undo" title="Undo (Ctrl+Z)"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M3 7v6h6M21 17a9 9 0 00-9-9 9 9 0 00-9 9"/>
                    </svg>
                </button>
                <button type="button" data-command="redo" title="Redo (Ctrl+Y)"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M21 7v6h-6M3 17a9 9 0 019-9 9 9 0 019 9"/>
                    </svg>
                </button>
                <button type="button" data-command="removeFormat" title="Clear Formatting"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <!-- Fullscreen Toggle -->
            <div class="flex items-center gap-1 px-3 border-l border-border ml-auto">
                <button type="button" @click="fullscreen = !fullscreen" title="Fullscreen Mode"
                        class="p-2 rounded-lg hover:bg-surface hover:shadow-sm text-text-muted hover:text-text-main transition-all">
                    <svg x-show="!fullscreen" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M8 3H5a2 2 0 00-2 2v3m18 0V5a2 2 0 00-2-2h-3m0 18h3a2 2 0 002-2v-3M3 16v3a2 2 0 002 2h3"/>
                    </svg>
                    <svg x-show="fullscreen" class="w-4 h-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24" style="display: none;">
                        <path d="M6 9l-3-3m0 0l3-3m-3 3h6m12 0l-3 3m3-3l-3-3m3 3h-6M9 18l-3 3m0 0l3 3m-3-3v-6m12 6l3 3m0 0l-3 3m3-3v-6"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Editor Area -->
        <div id="editor-content-{{ $attributes->wire('model')->value() }}"
             contenteditable="true"
             :class="fullscreen ? 'min-h-[calc(100vh-200px)]' : 'min-h-[300px] sm:min-h-[400px]'"
             class="p-4 sm:p-6
                    prose prose-sm sm:prose-base max-w-none
                    prose-headings:font-heading prose-headings:text-text-main
                    prose-p:text-text-muted prose-p:leading-relaxed
                    prose-a:text-primary-600 prose-a:no-underline hover:prose-a:underline
                    prose-ul:list-disc prose-ol:list-decimal
                   prose-blockquote:border-l-4 prose-blockquote:border-primary-500 prose-blockquote:pl-4 prose-blockquote:italic
                    prose-img:rounded-xl prose-img:shadow-md
                    focus:outline-none
                    overflow-y-auto"
             data-placeholder="Mulai menulis deskripsi event atau konten blog di sini...">
            {!! $value !!}
        </div>

        <!-- Hidden input for Livewire -->
        <input type="hidden" {{ $attributes->wire('model') }} id="hidden-input-{{ $attributes->wire('model')->value() }}">
    </div>

    <!-- Helper text -->
    <p class="mt-2 text-xs text-text-muted flex items-start gap-1.5">
        <svg class="w-4 h-4 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        <span>
            Gunakan toolbar untuk formatting teks. 
            <br>
            <strong>Shortcut:</strong> Ctrl+B = Bold, Ctrl+I = Italic, Ctrl+U = Underline, Ctrl+Z = Undo, Ctrl+Y = Redo, Ctrl+Shift+V = Paste tanpa format.
            <br>
            <strong>📋 Smart Paste:</strong> Format otomatis dibersihkan saat copy-paste dari Word/website untuk hasil yang lebih rapi.
        </span>
    </p>

    @error($attributes->wire('model')->value())
        <p class="mt-2 text-sm text-red-500 flex items-center">{{ $message }}</p>
    @enderror
</div>

<script>
// Add custom styles
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(-10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    @keyframes fadeOut {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(-10px); }
    }
    
    /* Placeholder styling */
    [contenteditable][data-placeholder]:empty:before {
        content: attr(data-placeholder);
        color: #9CA3AF;
        pointer-events: none;
        position: absolute;
    }
    
    /* Scrollbar styling */
    [contenteditable]::-webkit-scrollbar {
        width: 8px;
    }
    
    [contenteditable]::-webkit-scrollbar-track {
        background: transparent;
    }
    
    [contenteditable]::-webkit-scrollbar-thumb {
        background: #D1D5DB;
        border-radius: 4px;
    }
    
    [contenteditable]::-webkit-scrollbar-thumb:hover {
        background: #9CA3AF;
    }
    
    /* Fullscreen background overlay */
    [x-data] > div.fixed {
        background: rgba(0, 0, 0, 0.95);
    }
    
    /* Code block styling */
    #editor-content-{{ $attributes->wire('model')->value() }} pre {
        background-color: #F3F4F6 !important;
        border: 1px solid #E5E7EB !important;
        padding: 16px !important;
        border-radius: 12px !important;
        overflow-x: auto !important;
        font-family: 'Courier New', Courier, monospace;
        font-size: 14px;
        line-height: 1.6;
        color: #1F2937 !important;
        white-space: pre-wrap !important;
        display: block !important;
    }
    
    #editor-content-{{ $attributes->wire('model')->value() }} pre code {
        background: transparent !important;
        padding: 0 !important;
        color: #1F2937 !important;
        border: none !important;
        white-space: pre-wrap !important;
        display: block !important;
        font-family: inherit !important;
        font-size: inherit !important;
    }
    
    /* Inline code styling */
    #editor-content-{{ $attributes->wire('model')->value() }} code {
        background-color: #F3F4F6 !important;
        color: #EC4899 !important;
        padding: 2px 6px !important;
        border-radius: 4px !important;
        font-family: 'Courier New', Courier, monospace;
        font-size: 0.9em;
    }
    
    /* Blockquote styling */
    #editor-content-{{ $attributes->wire('model')->value() }} blockquote {
        border-left: 4px solid #3B82F6 !important;
        padding-left: 16px !important;
        font-style: italic;
        color: #6B7280 !important;
        margin: 16px 0;
    }
    
    /* Horizontal rule styling */
    #editor-content-{{ $attributes->wire('model')->value() }} hr {
        border: none;
        border-top: 2px solid #E5E7EB;
        margin: 24px 0;
    }
`;
document.head.appendChild(style);

document.addEventListener('DOMContentLoaded', function() {
    const editorId = 'editor-content-{{ $attributes->wire('model')->value() }}';
    const inputId = 'hidden-input-{{ $attributes->wire('model')->value() }}';
    
    const editor = document.getElementById(editorId);
    const hiddenInput = document.getElementById(inputId);

    if (!editor || !hiddenInput) return;

    // Update word and character count
    function updateStats() {
        const text = editor.innerText || '';
        const charCount = text.length;
        const wordCount = text.trim() ? text.trim().split(/\s+/).length : 0;
        
        // Update Alpine.js data
        const container = editor.closest('[x-data]');
        if (container && container.__x) {
            container.__x.$data.charCount = charCount;
            container.__x.$data.wordCount = wordCount;
        }
    }

    // Sync content to Livewire
    editor.addEventListener('input', function() {
        hiddenInput.value = editor.innerHTML;
        hiddenInput.dispatchEvent(new Event('input', { bubbles: true }));
        updateStats();
    });
    
    // Initial stats update
    updateStats();

    // Toolbar commands
    const toolbar = editor.closest('.border').querySelector('.flex-wrap');
    if (toolbar) {
        toolbar.querySelectorAll('[data-command]').forEach(btn => {
            btn.addEventListener('click', function() {
                const command = this.dataset.command;
                const value = this.dataset.value;

                if (command === 'createLink') {
                    const url = prompt('Masukkan URL:');
                    if (url) document.execCommand(command, false, url);
                } else if (command === 'insertImage') {
                     const url = prompt('Masukkan URL Gambar:');
                     if (url) document.execCommand(command, false, url);
                } else if (command === 'insertCode') {
                    insertCodeBlock();
                } else if (value) {
                    document.execCommand(command, false, value);
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

    
    // Function to insert code block
    function insertCodeBlock() {
        // Create modal
        const modal = document.createElement('div');
        modal.style.cssText = 'position: fixed; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center; z-index: 9999;';
        
        const modalContent = document.createElement('div');
        modalContent.style.cssText = 'background: white; padding: 24px; border-radius: 12px; width: 90%; max-width: 600px; max-height: 80vh; overflow: auto;';
        
        const title = document.createElement('h3');
        title.textContent = 'Insert Code Block';
        title.style.cssText = 'margin: 0 0 16px 0; font-size: 18px; font-weight: 700;';
        
        const textarea = document.createElement('textarea');
        textarea.placeholder = 'Paste your code here...';
        textarea.style.cssText = 'width: 100%; min-height: 300px; padding: 12px; font-family: "Courier New", monospace; font-size: 14px; border: 1px solid #E5E7EB; border-radius: 8px; resize: vertical;';
        
        const buttonContainer = document.createElement('div');
        buttonContainer.style.cssText = 'display: flex; gap: 12px; margin-top: 16px; justify-content: flex-end;';
        
        const cancelBtn = document.createElement('button');
        cancelBtn.textContent = 'Cancel';
        cancelBtn.type = 'button';
        cancelBtn.style.cssText = 'padding: 8px 16px; border: 1px solid #E5E7EB; background: white; border-radius: 8px; cursor: pointer;';
        cancelBtn.onclick = () => modal.remove();
        
        const insertBtn = document.createElement('button');
        insertBtn.textContent = 'Insert Code';
        insertBtn.type = 'button';
        insertBtn.style.cssText = 'padding: 8px 16px; border: none; background: #3B82F6; color: white; border-radius: 8px; cursor: pointer; font-weight: 600;';
        insertBtn.onclick = () => {
            const code = textarea.value;
            if (code) {
                const pre = document.createElement('pre');
                const codeElement = document.createElement('code');
                codeElement.textContent = code;
                pre.appendChild(codeElement);
                
                const selection = window.getSelection();
                if (selection.rangeCount > 0) {
                    const range = selection.getRangeAt(0);
                    range.deleteContents();
                    range.insertNode(pre);
                    
                    // Add line break after code block
                    const br = document.createElement('br');
                    pre.parentNode.insertBefore(br, pre.nextSibling);
                    
                    // Move cursor after code block
                    range.setStartAfter(br);
                    range.collapse(true);
                    selection.removeAllRanges();
                    selection.addRange(range);
                }
                editor.dispatchEvent(new Event('input'));
            }
            modal.remove();
            editor.focus();
        };
        
        buttonContainer.appendChild(cancelBtn);
        buttonContainer.appendChild(insertBtn);
        
        modalContent.appendChild(title);
        modalContent.appendChild(textarea);
        modalContent.appendChild(buttonContainer);
        modal.appendChild(modalContent);
        document.body.appendChild(modal);
        
        textarea.focus();
        
        // Close on backdrop click
        modal.addEventListener('click', (e) => {
            if (e.target === modal) modal.remove();
        });
        
        // Close on ESC
        document.addEventListener('keydown', function escHandler(e) {
            if (e.key === 'Escape') {
                modal.remove();
                document.removeEventListener('keydown', escHandler);
            }
        });
    }
        // Handle color inputs
        toolbar.querySelectorAll('input[type="color"]').forEach(input => {
            input.addEventListener('change', function() {
                const command = this.dataset.command;
                document.execCommand(command, false, this.value);
                editor.focus();
            });
        });
    }

    // Keyboard shortcuts
    editor.addEventListener('keydown', function(e) {
        if (e.ctrlKey && e.key === 'b') {
            e.preventDefault();
            document.execCommand('bold', false, null);
        }
        if (e.ctrlKey && e.key === 'i') {
            e.preventDefault();
            document.execCommand('italic', false, null);
        }
        if (e.ctrlKey && e.key === 'u') {
            e.preventDefault();
            document.execCommand('underline', false, null);
        }
        if (e.ctrlKey && e.key === 'z') {
            e.preventDefault();
            document.execCommand('undo', false, null);
        }
        if (e.ctrlKey && e.key === 'y') {
            e.preventDefault();
            document.execCommand('redo', false, null);
        }
        // Ctrl+Shift+V for paste as plain text
        if (e.ctrlKey && e.shiftKey && e.key === 'V') {
            e.preventDefault();
            navigator.clipboard.readText().then(text => {
                document.execCommand('insertText', false, text);
            });
        }
    });

    // Clean paste: Remove unwanted formatting when pasting
    editor.addEventListener('paste', function(e) {
        e.preventDefault();
        
        // Show paste indicator
        showPasteIndicator();
        
        // Get pasted data
        const clipboardData = e.clipboardData || window.clipboardData;
        let pastedHTML = clipboardData.getData('text/html');
        const pastedText = clipboardData.getData('text/plain');
        
        if (pastedHTML) {
            // Clean the HTML
            const cleanedHTML = cleanPastedHTML(pastedHTML);
            document.execCommand('insertHTML', false, cleanedHTML);
        } else if (pastedText) {
            // If no HTML, insert as plain text with line breaks preserved
            const formattedText = pastedText.replace(/\n/g, '<br>');
            document.execCommand('insertHTML', false, formattedText);
        }
        
        // Trigger input event to sync with Livewire
        editor.dispatchEvent(new Event('input'));
        
        // Hide paste indicator
        setTimeout(() => hidePasteIndicator(), 500);
    });
    
    // Paste indicator functions
    function showPasteIndicator() {
        // Remove existing indicator first
        const existingIndicator = editor.querySelector('.paste-indicator');
        if (existingIndicator) {
            existingIndicator.remove();
        }
        
        let indicator = editor.querySelector('.paste-indicator');
        if (!indicator) {
            indicator = document.createElement('div');
            indicator.className = 'paste-indicator';
            indicator.innerHTML = '<span class="text-xs bg-primary-500 text-white px-3 py-1 rounded-full shadow-lg">📋 Membersihkan format...</span>';
            indicator.style.cssText = 'position: absolute; top: 10px; right: 10px; z-index: 1000; opacity: 0; transition: opacity 0.2s;';
            editor.style.position = 'relative';
            editor.appendChild(indicator);
            // Trigger animation
            setTimeout(() => {
                indicator.style.opacity = '1';
            }, 10);
        }
    }
    
    function hidePasteIndicator() {
        const indicator = editor.querySelector('.paste-indicator');
        if (indicator) {
            indicator.style.opacity = '0';
            setTimeout(() => {
                if (indicator && indicator.parentNode) {
                    indicator.remove();
                }
            }, 200);
        }
    }
    
    // Function to clean pasted HTML
    function cleanPastedHTML(html) {
        // Create a temporary div to parse HTML
        const temp = document.createElement('div');
        temp.innerHTML = html;
        
        // Allowed tags
        const allowedTags = ['P', 'BR', 'STRONG', 'B', 'EM', 'I', 'U', 'S', 'STRIKE', 
                            'H1', 'H2', 'H3', 'H4', 'H5', 'H6',
                            'UL', 'OL', 'LI', 
                            'A', 'IMG',
                            'BLOCKQUOTE', 'PRE', 'CODE', 'HR'];
        
        // Recursively clean nodes
        function cleanNode(node) {
            // Remove comments
            if (node.nodeType === 8) {
                node.remove();
                return;
            }
            
            // Keep text nodes
            if (node.nodeType === 3) {
                return;
            }
            
            // Process element nodes
            if (node.nodeType === 1) {
                const tagName = node.tagName.toUpperCase();
                
                // Remove script and style tags
                if (tagName === 'SCRIPT' || tagName === 'STYLE') {
                    node.remove();
                    return;
                }
                
                // If tag is not allowed, replace with its content
                if (!allowedTags.includes(tagName)) {
                    const fragment = document.createDocumentFragment();
                    while (node.firstChild) {
                        fragment.appendChild(node.firstChild);
                    }
                    node.replaceWith(fragment);
                    return;
                }
                
                // Clean attributes
                const allowedAttrs = ['href', 'src', 'alt'];
                Array.from(node.attributes).forEach(attr => {
                    if (!allowedAttrs.includes(attr.name.toLowerCase())) {
                        node.removeAttribute(attr.name);
                    }
                });
                
                // Normalize bold/italic tags
                if (tagName === 'B') {
                    const strong = document.createElement('strong');
                    while (node.firstChild) {
                        strong.appendChild(node.firstChild);
                    }
                    node.replaceWith(strong);
                    node = strong;
                }
                if (tagName === 'I') {
                    const em = document.createElement('em');
                    while (node.firstChild) {
                        em.appendChild(node.firstChild);
                    }
                    node.replaceWith(em);
                    node = em;
                }
                if (tagName === 'STRIKE') {
                    const s = document.createElement('s');
                    while (node.firstChild) {
                        s.appendChild(node.firstChild);
                    }
                    node.replaceWith(s);
                    node = s;
                }
                
                // Process children
                Array.from(node.childNodes).forEach(child => {
                    cleanNode(child);
                });
            }
        }
        
        // Clean all nodes
        Array.from(temp.childNodes).forEach(node => {
            cleanNode(node);
        });
        
        return temp.innerHTML;
    }

    // Placeholder behavior (optional, CSS can handle empty state too)
    editor.addEventListener('focus', function() {
        if (this.innerHTML === '' || this.innerHTML === '<br>') {
            // this.innerHTML = '';
        }
    });
});
</script>
