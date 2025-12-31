<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Post;
use Illuminate\Database\QueryException;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Home extends Component
{
    /**
     * Render the home page with events and latest posts
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $cache = public_cache();

        $title = 'HIMA-SIKC Event Center - Pusat Informasi Lomba & Event Mahasiswa';
        $description = 'HIMA-SIKC Event Center adalah pusat informasi kompetisi, lomba, event, dan kegiatan mahasiswa Sistem Informasi Kota Cerdas Politeknik Negeri Indramayu. Temukan peluang prestasi Anda di sini.';
        $keywords = 'HIMA SIKC, HIMA-SIKC Event Center, event center, lomba mahasiswa, kompetisi, politeknik indramayu, sistem informasi kota cerdas, polindra, seminar, workshop';
        $canonical = url('/');

        $organizationSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'Organization',
            'name' => 'HIMA SIKC',
            'url' => $canonical,
            'logo' => asset('logo.png'),
            'sameAs' => [
                'https://www.instagram.com/himasikc_polindra/',
            ],
        ];

        $websiteSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            'name' => 'HIMA SIKC Event Center',
            'url' => $canonical,
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => url('/events').'?search={search_term_string}',
                'query-input' => 'required name=search_term_string',
            ],
        ];

        $structuredData = implode('', [
            '<script type="application/ld+json">'.json_encode($organizationSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE).'</script>',
            '<script type="application/ld+json">'.json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE).'</script>',
        ]);

        try {
            $featuredEvents = $cache->remember('home.featured_events', 300, function () {
                return Event::with('category')
                    ->where('is_active', true)
                    ->orderBy('id', 'desc')
                    ->take(13)
                    ->get();
            });
        } catch (QueryException $e) {
            report($e);
            $featuredEvents = collect();
        }

        try {
            $latestPosts = $cache->remember('home.latest_posts', 300, function () {
                return Post::with(['user', 'category'])
                    ->where('is_published', true)
                    ->orderBy('id', 'desc')
                    ->take(9)
                    ->get();
            });
        } catch (QueryException $e) {
            report($e);
            $latestPosts = collect();
        }

        $heroSection = $cache->remember('home.hero_section', 300, function () {
            return \App\Models\HeroSection::first();
        });

        $totalEvents = $cache->remember('home.total_events', 300, function () {
            return Event::where('is_active', true)->count();
        });

        $totalPosts = $cache->remember('home.total_posts', 300, function () {
            return Post::where('is_published', true)->count();
        });

        $testimonials = $cache->remember('home.testimonials', 300, function () {
            return \App\Models\Testimonial::where('is_active', true)->latest()->get();
        });

        return view('livewire.home', [
            'featuredEvents' => $featuredEvents,
            'latestPosts' => $latestPosts,
            'totalEvents' => $totalEvents,
            'totalPosts' => $totalPosts,
            'heroSection' => $heroSection,
            'testimonials' => $testimonials,
        ])->layoutData([
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'canonical' => $canonical,
            'structuredData' => $structuredData,
        ]);
    }
}
