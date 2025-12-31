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
                          class="relative h-[300px] sm:h-[400px] overflow-hidden bg-surface-secondary">
                         @if ($post->image_path)
                             <img src="{{ asset('storage/' . $post->image_path) }}" 
                                  alt="{{ $post->title }}" 
                                  class="w-full h-full object-cover transition-transform duration-100 ease-linear"
                                  loading="eager"
                                  fetchpriority="high"
                                  :style="`transform: translateY(${scroll * 0.2}px) scale(1.1)`">
                             <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent"></div>
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
 
                             <h1 class="text-3xl sm:text-4xl lg:text-5xl font-bold text-text-main leading-tight mb-8 font-heading tracking-tight">
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
                             <div class="text-text-muted leading-relaxed space-y-6">
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
 </div>
 </div>
