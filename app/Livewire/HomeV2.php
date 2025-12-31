<?php

namespace App\Livewire;

use App\Models\Event;
use App\Models\Post;
use function App\Providers\public_cache;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class HomeV2 extends Component
{
    public function render()
    {
        $cache = public_cache();

        $title = 'HIMA SIKC Event Center - Modern';
        $description = 'Platform digital modern untuk event, kompetisi, dan kegiatan mahasiswa Sistem Informasi Kota Cerdas Politeknik Negeri Indramayu.';
        $keywords = 'HIMA SIKC, event center, mahasiswa, politeknik indramayu, sistem informasi kota cerdas, kompetisi, seminar';
        $canonical = url('/v2');

        try {
            $featuredEvents = $cache->remember('home.featured_events', 300, function () {
                return Event::with('category')
                    ->where('is_active', true)
                    ->orderBy('id', 'desc')
                    ->take(6)
                    ->get();
            });
        } catch (\Exception $e) {
            report($e);
            $featuredEvents = collect();
        }

        try {
            $latestPosts = $cache->remember('home.latest_posts', 300, function () {
                return Post::with(['user', 'category'])
                    ->where('is_published', true)
                    ->orderBy('id', 'desc')
                    ->take(6)
                    ->get();
            });
        } catch (\Exception $e) {
            report($e);
            $latestPosts = collect();
        }

        return view('livewire.home-v2', [
            'featuredEvents' => $featuredEvents,
            'latestPosts' => $latestPosts,
        ])->layoutData([
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'canonical' => $canonical,
        ]);
    }
}
