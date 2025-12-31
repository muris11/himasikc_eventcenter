<?php

namespace App\Console\Commands;

use App\Models\Event;
use App\Models\Post;
use Illuminate\Console\Command;

class SeoCheckCommand extends Command
{
    protected $signature = 'seo:check';

    protected $description = 'Check SEO implementation across the application';

    public function handle()
    {
        $this->info('🔍 Checking SEO Implementation...');

        // Check events
        $events = Event::all();
        foreach ($events as $event) {
            if (! $event->slug) {
                $this->error("❌ Event '{$event->title}' missing slug");
            }
            if (! $event->image_path) {
                $this->warn("⚠️  Event '{$event->title}' missing image");
            }
        }

        // Check posts
        $posts = Post::all();
        foreach ($posts as $post) {
            if (! $post->slug) {
                $this->error("❌ Post '{$post->title}' missing slug");
            }
            if (! $post->is_published) {
                $this->warn("⚠️  Post '{$post->title}' not published");
            }
        }

        $this->info('✅ SEO Check Complete!');

        return 0;
    }
}
