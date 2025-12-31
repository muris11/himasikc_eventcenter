<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    protected $fillable = [
        'ip_address',
        'user_agent',
        'url',
        'referer',
        'session_id',
        'visited_at',
    ];

    protected $casts = [
        'visited_at' => 'datetime',
    ];

    // Method untuk mendapatkan total visitors hari ini
    public static function getTodayVisitors()
    {
        return static::whereDate('visited_at', Carbon::today())->count();
    }

    // Method untuk mendapatkan total visitors bulan ini
    public static function getMonthlyVisitors()
    {
        return static::whereMonth('visited_at', Carbon::now()->month)
            ->whereYear('visited_at', Carbon::now()->year)
            ->count();
    }

    // Method untuk mendapatkan total visitors tahun ini
    public static function getYearlyVisitors()
    {
        return static::whereYear('visited_at', Carbon::now()->year)->count();
    }

    // Method untuk mendapatkan total visitors unik berdasarkan IP
    public static function getUniqueVisitors()
    {
        return static::distinct('ip_address')->count('ip_address');
    }

    // Method untuk mendapatkan visitors per hari (7 hari terakhir)
    public static function getVisitorsLast7Days()
    {
        return static::selectRaw('DATE(visited_at) as date, COUNT(*) as count')
            ->where('visited_at', '>=', Carbon::now()->subDays(7))
            ->groupBy('date')
            ->orderBy('date')
            ->get();
    }
}
