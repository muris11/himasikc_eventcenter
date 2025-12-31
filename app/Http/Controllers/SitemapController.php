<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Post;

class SitemapController extends Controller
{
    public function index()
    {
        $events = Event::where('is_active', true)->latest()->get();
        $posts = Post::where('is_published', true)->latest()->get();

        return response()->view('sitemap.index', [
            'events' => $events,
            'posts' => $posts,
        ])->header('Content-Type', 'text/xml');
    }
}
