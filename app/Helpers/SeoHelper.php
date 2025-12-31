<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SeoHelper
{
    /**
     * Generate structured data for events
     */
    public static function generateEventStructuredData($event)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'Event',
            'name' => $event->title,
            'description' => Str::limit(strip_tags($event->description), 500),
            'image' => $event->image_path ? Storage::url($event->image_path) : asset('images/featured-event.png'),
            'startDate' => $event->date->format('Y-m-d\TH:i:s'),
            'endDate' => $event->date->format('Y-m-d\TH:i:s'),
            'eventStatus' => $event->is_active ? 'https://schema.org/EventScheduled' : 'https://schema.org/EventCancelled',
            'eventAttendanceMode' => 'https://schema.org/OfflineEventAttendanceMode',
            'location' => [
                '@type' => 'Place',
                'name' => $event->location,
                'address' => [
                    '@type' => 'PostalAddress',
                    'streetAddress' => $event->location,
                    'addressLocality' => 'Indramayu',
                    'addressRegion' => 'Jawa Barat',
                    'addressCountry' => 'ID',
                ],
            ],
            'organizer' => [
                '@type' => 'Organization',
                'name' => 'HIMA SIKC',
                'url' => url('/'),
            ],
            'offers' => [
                '@type' => 'Offer',
                'price' => '0',
                'priceCurrency' => 'IDR',
                'availability' => 'https://schema.org/InStock',
                'validFrom' => $event->created_at->format('Y-m-d'),
                'url' => $event->registration_link ?? route('events.show', $event->slug),
            ],
            'url' => route('events.show', $event->slug),
        ];
    }

    /**
     * Generate structured data for blog posts
     */
    public static function generateBlogStructuredData($post)
    {
        return [
            '@context' => 'https://schema.org',
            '@type' => 'BlogPosting',
            'headline' => $post->title,
            'description' => Str::limit(strip_tags($post->content), 500),
            'image' => $post->image_path ? Storage::url($post->image_path) : asset('images/featured-event.png'),
            'author' => [
                '@type' => 'Person',
                'name' => $post->user->name ?? 'Admin',
            ],
            'publisher' => [
                '@type' => 'Organization',
                'name' => 'HIMA SIKC',
                'url' => url('/'),
                'logo' => [
                    '@type' => 'ImageObject',
                    'url' => asset('images/logo.png'),
                ],
            ],
            'datePublished' => $post->created_at->format('Y-m-d\TH:i:s'),
            'dateModified' => $post->updated_at->format('Y-m-d\TH:i:s'),
            'mainEntityOfPage' => [
                '@type' => 'WebPage',
                '@id' => route('blog.show', $post->slug),
            ],
            'url' => route('blog.show', $post->slug),
            'articleSection' => optional($post->category)->name ?? 'Blog',
            'wordCount' => str_word_count(strip_tags($post->content)),
            'timeRequired' => 'PT5M',
        ];
    }

    /**
     * Generate meta tags array
     */
    public static function generateMetaTags($data)
    {
        return [
            'title' => $data['title'] ?? config('app.name'),
            'description' => $data['description'] ?? 'Platform digital terintegrasi untuk mahasiswa Sistem Informasi Kota Cerdas Politeknik Negeri Indramayu.',
            'keywords' => $data['keywords'] ?? 'HIMA SIKC, event center, mahasiswa, politeknik indramayu, sistem informasi kota cerdas',
            'canonical' => $data['canonical'] ?? url()->current(),
            'og_type' => $data['og_type'] ?? 'website',
            'og_title' => $data['og_title'] ?? ($data['title'] ?? config('app.name')),
            'og_description' => $data['og_description'] ?? ($data['description'] ?? 'Platform digital terintegrasi untuk mahasiswa Sistem Informasi Kota Cerdas Politeknik Negeri Indramayu.'),
            'og_image' => $data['og_image'] ?? asset('images/featured-event.png'),
            'twitter_title' => $data['twitter_title'] ?? ($data['title'] ?? config('app.name')),
            'twitter_description' => $data['twitter_description'] ?? ($data['description'] ?? 'Platform digital terintegrasi untuk mahasiswa Sistem Informasi Kota Cerdas Politeknik Negeri Indramayu.'),
            'twitter_image' => $data['twitter_image'] ?? asset('images/twitter-default.jpg'),
            'robots' => $data['robots'] ?? 'index, follow',
            'googlebot' => $data['googlebot'] ?? 'index, follow, max-video-preview:-1, max-image-preview:large, max-snippet:-1',
        ];
    }
}
