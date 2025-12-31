 <div>
 {{-- Reading Progress Bar --}}
 <div x-data="{ progress: 0 }"
      @scroll.window="progress = Math.min(100, Math.max(0, (window.scrollY / (document.documentElement.scrollHeight - window.innerHeight)) * 100))"
      style="display: none;"
      x-init="$el.style.display = 'block'">
     <div class="fixed top-0 left-0 h-1.5 bg-gradient-to-r from-primary-500 to-primary-300 z-[60] transition-all duration-150"
          :style="`width: ${progress}%`"></div>
 </div>
 
 <div class="py-12 bg-background min-h-screen pb-24 lg:pb-12">
     <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
         
         {{-- Breadcrumb --}}
         <nav class="flex mb-8 text-sm" aria-label="Breadcrumb">
             <ol class="flex flex-wrap items-center gap-x-1 gap-y-1 md:gap-x-3">
                 <li class="inline-flex items-center">
                     <a href="{{ route('home') }}" class="text-text-muted hover:text-primary-600 transition-colors flex items-center gap-1">
                         <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                         </svg>
                         Beranda
                     </a>
                 </li>
                 <li>
                     <div class="flex items-center">
                         <svg class="w-4 h-4 text-text-muted mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                         </svg>
                         <a href="{{ route('blog.index') }}" class="ml-1 text-text-muted hover:text-primary-600 transition-colors">Blog</a>
                     </div>
                 </li>
                 <li aria-current="page">
                     <div class="flex items-center">
                         <svg class="w-4 h-4 text-text-muted mx-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                             <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"/>
                         </svg>
                         <span class="ml-1 text-text-main font-medium whitespace-normal break-words">{{ $post->title }}</span>
                     </div>
                 </li>
             </ol>
         </nav>
 
         <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
             {{-- Main Content --}}
             <div class="lg:col-span-2">
                 <article class="bg-surface rounded-[2.5rem] border border-border overflow-hidden shadow-sm">
                     {{-- Hero Image with Parallax Effect --}}
                     <div x-data="{ scroll: 0 }" 
                          @scroll.window="scroll = window.pageYOffset"
                          class="relative overflow-hidden bg-surface-secondary">
                         @if ($post->image_path)
                             <img src="{{ asset('storage/' . $post->image_path) }}" 
                                  alt="{{ $post->title }}" 
                                  class="w-full h-auto object-contain max-h-[400px] sm:max-h-[500px]"
                                  loading="eager"
                                  fetchpriority="high">
                         @else
                             <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-50 to-primary-100">
                                 <svg class="w-20 h-20 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                     <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/>
                                 </svg>
                             </div>
                         @endif
                     </div>
 
                     <div class="p-8 sm:p-10">
                         {{-- Header --}}
                         <div class="mb-10 border-b border-border pb-10">
                             <div class="flex flex-wrap items-center gap-3 mb-5 text-sm">
                                 @if($post->category)
                                     <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-primary-50 text-primary-700 border border-primary-100 uppercase tracking-wide">
                                         {{ $post->category->name }}
                                     </span>
                                 @endif
                                 <span class="text-text-muted">•</span>
                                 <span class="text-text-muted font-medium flex items-center gap-1.5">
                                     <svg class="w-4 h-4 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                     {{ $post->created_at->format('d M Y') }}
                                 </span>
                             </div>
 
                             <h1 class="text-2xl sm:text-3xl lg:text-4xl font-bold text-text-main leading-tight mb-8 font-heading tracking-tight">
                                 {{ $post->title }}
                             </h1>
                             
                             <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-6">
                                 <div class="flex items-center gap-4">
                                     <div class="w-12 h-12 rounded-full bg-gradient-to-br from-primary-500 to-primary-600 flex items-center justify-center text-white font-bold text-lg shadow-md ring-2 ring-white">
                                         {{ substr($post->user->name ?? 'A', 0, 1) }}
                                     </div>
                                     <div>
                                         <p class="text-base font-bold text-text-main">{{ $post->user->name ?? 'Admin' }}</p>
                                         <p class="text-xs text-text-muted font-bold uppercase tracking-wider">Penulis</p>
                                     </div>
                                 </div>
                                 
                                 {{-- Share --}}
                                 <div class="flex items-center gap-3">
                                     <span class="text-xs font-bold text-text-muted uppercase tracking-wider mr-1">Bagikan</span>
                                      <button onclick="sharePostToWhatsApp()" class="p-2.5 bg-surface-secondary text-text-muted hover:text-white hover:bg-[#25D366] rounded-xl transition-all duration-300 hover:-translate-y-1 shadow-sm" title="WhatsApp">
                                         <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.885 3.488" /></svg>
                                     </button>
                                     <button onclick="copyLink()" class="p-2.5 bg-surface-secondary text-text-muted hover:text-white hover:bg-primary-500 rounded-xl transition-all duration-300 hover:-translate-y-1 shadow-sm" title="Copy Link">
                                         <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 16H6a2 2 0 01-2-2V6a2 2 0 012-2h8a2 2 0 012 2v2m-6 12h8a2 2 0 002-2v-8a2 2 0 00-2-2h-8a2 2 0 00-2 2v8a2 2 0 002 2z"/></svg>
                                     </button>
                                 </div>
                             </div>
                         </div>
 
                         {{-- Content --}}
                         <div class="blog-content">
                             <div class="prose prose-lg max-w-none prose-headings:text-text-main prose-p:text-text-muted prose-a:text-primary-600 prose-strong:text-text-main prose-ul:my-4 prose-ol:my-4 prose-li:my-2">
                                 {!! auto_format_text($post->content) !!}
                             </div>
                         </div>
                     </div>
                 </article>
             </div>
 
             {{-- Sidebar --}}
             <div class="lg:col-span-1 space-y-8">
                 {{-- Latest Posts Widget --}}
                  @if (isset($relatedPosts) && $relatedPosts->count() > 0)
                     <div class="bg-surface rounded-3xl border border-border shadow-sm p-8 lg:sticky lg:top-24">
                         <h3 class="font-bold text-text-main font-heading text-lg mb-6 pb-4 border-b border-border">Artikel Terkait</h3>
                         <div class="space-y-5">
                             @foreach($relatedPosts as $relPost)
                                 <a href="{{ route('blog.show', $relPost) }}" class="flex gap-4 group">
                                     <div class="w-20 h-20 bg-surface-secondary rounded-xl overflow-hidden shrink-0 border border-border relative">
                                          @if ($relPost->image_path)
                                             <img src="{{ asset('storage/' . $relPost->image_path) }}" alt="{{ $relPost->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" loading="lazy">
                                         @else
                                             <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-primary-50 to-primary-100">
                                                 <svg class="w-8 h-8 text-primary-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z"/></svg>
                                             </div>
                                         @endif
                                     </div>
                                     <div class="flex-1 min-w-0 py-1">
                                         <h4 class="text-sm font-bold text-text-main line-clamp-2 group-hover:text-primary-600 transition-colors mb-1.5 leading-snug">
                                             {{ $relPost->title }}
                                         </h4>
                                         <p class="text-xs text-text-muted font-medium flex items-center gap-1.5">
                                             <svg class="w-3.5 h-3.5 text-primary-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                             {{ $relPost->created_at->format('d M Y') }}
                                         </p>
                                     </div>
                                 </a>
                             @endforeach
                         </div>
                     </div>
                 @endif
             </div>
         </div>
     </div>
 
     {{-- Minimal JS for Sharing --}}
     <script>
         function sharePostToWhatsApp() {
             const url = window.location.href;
             const title = "{{ $post->title }}";
             const text = `*${title}*\n${url}`;
             window.open(`https://api.whatsapp.com/send?text=${encodeURIComponent(text)}`, '_blank');
         }
 
         function copyLink() {
             const url = window.location.href;
             if (navigator.clipboard && window.isSecureContext) {
                 navigator.clipboard.writeText(url).then(() => {
                     window.dispatchEvent(new CustomEvent('notify', {
                         detail: { message: 'Link berhasil disalin!', type: 'success' }
                     }));
                 });
                 return;
             }
 
             const input = document.createElement('input');
             input.value = url;
             document.body.appendChild(input);
             input.select();
             document.execCommand('copy');
             document.body.removeChild(input);
             window.dispatchEvent(new CustomEvent('notify', {
                 detail: { message: 'Link berhasil disalin!', type: 'success' }
             }));
         }
     </script>
    
    <!-- Highlight.js for Syntax Highlighting -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/styles/atom-one-light.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/11.9.0/highlight.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Apply syntax highlighting to all code blocks
            document.querySelectorAll('.blog-content pre code').forEach((block) => {
                hljs.highlightElement(block);
            });
        });
    </script>
    
    <style>
        /* Reset dan base styling untuk blog content */
        .blog-content * {
            margin: 0;
            padding: 0;
        }
        
        .blog-content {
            font-size: 15px !important;
            line-height: 1.8 !important;
            color: #4B5563 !important;
        }
        
        /* Code block styling for blog content */
        .blog-content pre {
            background-color: #FAFAFA !important;
            border: 1px solid #E0E0E0 !important;
            padding: 20px !important;
            border-radius: 12px !important;
            overflow-x: auto !important;
            font-family: 'Courier New', Courier, monospace;
            font-size: 14px !important;
            line-height: 1.6 !important;
            margin: 24px 0 !important;
            display: block !important;
            white-space: pre-wrap !important;
            overflow-y: auto !important;
            max-height: 500px !important;
            word-break: break-word !important;
        }
        
        .blog-content pre code {
            background: transparent !important;
            padding: 0 !important;
            border: none !important;
            font-size: inherit !important;
            font-family: inherit !important;
            display: block !important;
            white-space: pre-wrap !important;
            word-wrap: break-word !important;
        }
        
        /* Inline code styling */
        .blog-content :not(pre) > code {
            background-color: #F3F4F6 !important;
            color: #EC4899 !important;
            padding: 2px 8px !important;
            border-radius: 6px !important;
            font-family: 'Courier New', Courier, monospace;
            font-size: 0.9em;
            font-weight: 500 !important;
        }
        
        /* Blockquote styling */
        .blog-content blockquote {
            border-left: 4px solid #3B82F6 !important;
            padding: 16px 24px !important;
            font-style: italic !important;
            color: #6B7280 !important;
            margin: 24px 0 !important;
            background-color: #F9FAFB !important;
            border-radius: 8px !important;
            font-size: 1.05em !important;
            line-height: 1.7 !important;
        }
        
        .blog-content blockquote p {
            margin: 0 !important;
        }
        
        .blog-content blockquote p:not(:last-child) {
            margin-bottom: 12px !important;
        }
        
        /* Horizontal rule styling */
        .blog-content hr {
            border: none !important;
            border-top: 2px solid #E5E7EB !important;
            margin: 40px 0 !important;
            height: 0 !important;
        }
        
        /* Lists styling */
        .blog-content ul,
        .blog-content ol {
            margin: 24px 0 !important;
            padding-left: 40px !important;
            color: #4B5563 !important;
            list-style-position: outside !important;
        }
        
        .blog-content li {
            margin: 12px 0 !important;
            line-height: 1.8 !important;
            color: #4B5563 !important;
            padding-left: 8px !important;
        }
        
        .blog-content ul {
            list-style-type: disc !important;
        }
        
        .blog-content ol {
            list-style-type: decimal !important;
        }
        
        .blog-content ul ul {
            list-style-type: circle !important;
            margin: 8px 0 !important;
        }
        
        .blog-content ol ol {
            list-style-type: lower-alpha !important;
            margin: 8px 0 !important;
        }
        
        /* Headings in content */
        .blog-content h1,
        .blog-content h2,
        .blog-content h3,
        .blog-content h4,
        .blog-content h5,
        .blog-content h6 {
            font-weight: 700 !important;
            margin-top: 48px !important;
            margin-bottom: 24px !important;
            color: #1F2937 !important;
            line-height: 1.3 !important;
            font-family: inherit !important;
        }
        
        .blog-content h1:first-child,
        .blog-content h2:first-child,
        .blog-content h3:first-child,
        .blog-content h4:first-child,
        .blog-content h5:first-child,
        .blog-content h6:first-child {
            margin-top: 0 !important;
        }
        
        .blog-content h1 { font-size: 1.75em !important; }
        .blog-content h2 { font-size: 1.375em !important; }
        .blog-content h3 { font-size: 1.125em !important; }
        .blog-content h4 { font-size: 1em !important; }
        .blog-content h5 { font-size: 0.9em !important; }
        .blog-content h6 { font-size: 0.85em !important; }
        
        /* Paragraphs */
        .blog-content p {
            margin: 0 0 20px 0 !important;
            line-height: 1.8 !important;
            color: #4B5563 !important;
            font-size: 15px !important;
            text-align: justify !important;
            word-spacing: 0.05em !important;
        }
        
        .blog-content p:first-child {
            margin-top: 0 !important;
        }
        
        .blog-content p:last-child {
            margin-bottom: 0 !important;
        }
        
        .blog-content p + p {
            margin-top: 20px !important;
        }
        
        .blog-content h1 + p,
        .blog-content h2 + p,
        .blog-content h3 + p,
        .blog-content h4 + p,
        .blog-content h5 + p,
        .blog-content h6 + p {
            margin-top: 0 !important;
        }
        
        /* Links */
        .blog-content a {
            color: #3B82F6 !important;
            text-decoration: underline !important;
            text-decoration-thickness: 1px !important;
            text-underline-offset: 2px !important;
            font-weight: 500 !important;
            transition: all 0.2s !important;
        }
        
        .blog-content a:hover {
            color: #2563EB !important;
            text-decoration-thickness: 2px !important;
        }
        
        /* Images */
        .blog-content img {
            border-radius: 12px !important;
            max-width: 100% !important;
            height: auto !important;
            margin: 32px auto !important;
            display: block !important;
            box-shadow: 0 10px 25px -5px rgb(0 0 0 / 0.1), 0 8px 10px -6px rgb(0 0 0 / 0.1) !important;
        }
        
        /* Strong/Bold */
        .blog-content strong,
        .blog-content b {
            font-weight: 700 !important;
            color: #1F2937 !important;
        }
        
        /* Italic/Em */
        .blog-content em,
        .blog-content i {
            font-style: italic !important;
        }
        
        /* Underline */
        .blog-content u {
            text-decoration: underline !important;
        }
        
        /* Strikethrough */
        .blog-content s,
        .blog-content strike,
        .blog-content del {
            text-decoration: line-through !important;
        }
        
        /* Superscript & Subscript */
        .blog-content sup {
            vertical-align: super !important;
            font-size: 0.75em !important;
        }
        
        .blog-content sub {
            vertical-align: sub !important;
            font-size: 0.75em !important;
        }
        
        /* Tables (if any) */
        .blog-content table {
            width: 100% !important;
            border-collapse: collapse !important;
            margin: 24px 0 !important;
        }
        
        .blog-content table th,
        .blog-content table td {
            padding: 12px 16px !important;
            border: 1px solid #E5E7EB !important;
            text-align: left !important;
        }
        
        .blog-content table th {
            background-color: #F9FAFB !important;
            font-weight: 700 !important;
            color: #1F2937 !important;
        }
        
        .blog-content table td {
            color: #4B5563 !important;
        }
        
        /* Spacing between different elements */
        .blog-content h1 + h2,
        .blog-content h2 + h3,
        .blog-content h3 + h4,
        .blog-content h4 + h5,
        .blog-content h5 + h6 {
            margin-top: 24px !important;
        }
        
        .blog-content ul + p,
        .blog-content ol + p,
        .blog-content p + ul,
        .blog-content p + ol {
            margin-top: 20px !important;
        }
        
        .blog-content ul + h1,
        .blog-content ul + h2,
        .blog-content ul + h3,
        .blog-content ul + h4,
        .blog-content ul + h5,
        .blog-content ul + h6,
        .blog-content ol + h1,
        .blog-content ol + h2,
        .blog-content ol + h3,
        .blog-content ol + h4,
        .blog-content ol + h5,
        .blog-content ol + h6 {
            margin-top: 48px !important;
        }
        
        /* Remove any unwanted margins on first/last elements */
        .blog-content > *:first-child {
            margin-top: 0 !important;
        }
        
        .blog-content > *:last-child {
            margin-bottom: 0 !important;
        }
    </style>
 </div>
 </div>
