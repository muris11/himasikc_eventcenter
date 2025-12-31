<?php

namespace App\Livewire\Admin;

use App\Models\Event;
use App\Models\EventCategory;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\Visitor;
use Illuminate\Support\Facades\Cache;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.admin')]
class Dashboard extends Component
{
    public function render()
    {
        // Cache statistik untuk 5 menit untuk mengurangi query berulang
        $stats = Cache::remember('admin.dashboard.stats', 300, function () {
            return [
                'totalEvents' => Event::count(),
                'activeEvents' => Event::where('is_active', true)->count(),
                'totalPosts' => Post::count(),
                'publishedPosts' => Post::where('is_published', true)->count(),
                'totalEventCategories' => EventCategory::count(),
                'totalBlogCategories' => PostCategory::count(),
                'eventsByCategory' => EventCategory::withCount('events')->get()->map(function ($category) {
                    return [
                        'name' => $category->name,
                        'count' => $category->events_count,
                    ];
                }),
            ];
        });

        return view('livewire.admin.dashboard', [
            ...$stats,
            'recentEvents' => Event::with('category')->orderBy('created_at', 'desc')->take(5)->get(),
            'recentPosts' => Post::with(['user', 'category'])->orderBy('created_at', 'desc')->take(5)->get(),
            'upcomingEvents' => Event::with('category')->where('is_active', true)->where('date', '>=', now())->orderBy('date', 'asc')->take(5)->get(),
            // Visitor statistics
            'todayVisitors' => Visitor::getTodayVisitors(),
            'monthlyVisitors' => Visitor::getMonthlyVisitors(),
            'yearlyVisitors' => Visitor::getYearlyVisitors(),
            'uniqueVisitors' => Visitor::getUniqueVisitors(),
            'visitorsLast7Days' => Visitor::getVisitorsLast7Days(),
        ])->layoutData([
            'title' => 'Dashboard Admin - HIMA SIKC Event Center',
        ]);
    }
}
