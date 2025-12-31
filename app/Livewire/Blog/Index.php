<?php

namespace App\Livewire\Blog;

use App\Models\Post;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts.app')]
class Index extends Component
{
    use WithPagination;

    public function render()
    {
        $title = 'Blog & Artikel | HIMA-SIKC Event Center';
        $description = 'Baca artikel menarik seputar teknologi, programming, tips lomba, dan perkembangan mahasiswa di HIMA-SIKC Event Center Politeknik Negeri Indramayu.';
        $keywords = 'blog HIMA SIKC, artikel teknologi, tips lomba, programming, mahasiswa polindra, HIMA-SIKC Event Center';
        $canonical = route('blog.index');

        $totalPosts = Cache::remember('blog.total_posts', 600, function () {
            return Post::where('is_published', true)->count();
        });

        $posts = Post::with(['user', 'category'])
            ->where('is_published', true)
            ->orderBy('id', 'desc')
            ->paginate(6);

        $blogPostSchema = $posts
            ->getCollection()
            ->map(function ($post) {
                return [
                    '@type' => 'BlogPosting',
                    'headline' => $post->title,
                    'description' => \Illuminate\Support\Str::limit(strip_tags((string) $post->content), 160),
                    'author' => [
                        '@type' => 'Person',
                        'name' => $post->user->name ?? 'Admin',
                    ],
                    'datePublished' => optional($post->created_at)->format('Y-m-d\\TH:i:s'),
                    'dateModified' => optional($post->updated_at)->format('Y-m-d\\TH:i:s'),
                    'url' => route('blog.show', $post->slug),
                    'mainEntityOfPage' => [
                        '@type' => 'WebPage',
                        '@id' => route('blog.show', $post->slug),
                    ],
                    'publisher' => [
                        '@type' => 'Organization',
                        'name' => 'HIMA SIKC',
                    ],
                ];
            })
            ->values()
            ->all();

        $structuredData = '<script type="application/ld+json">'.json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Blog',
            'name' => 'Blog HIMA SIKC',
            'description' => $description,
            'url' => $canonical,
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'HIMA SIKC',
                'url' => url('/'),
            ],
            'blogPost' => $blogPostSchema,
        ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE).'</script>';

        return view('livewire.blog.index', [
            'posts' => $posts,
            'totalPosts' => $totalPosts,
        ])->layoutData([
            'title' => $title,
            'description' => $description,
            'keywords' => $keywords,
            'canonical' => $canonical,
            'structuredData' => $structuredData,
        ]);
    }
}
