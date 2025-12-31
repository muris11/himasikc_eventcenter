<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class VisitorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $visitors = [];

        // Generate dummy visitors for the last 7 days
        for ($i = 6; $i >= 0; $i--) {
            $date = Carbon::now()->subDays($i);
            $count = rand(5, 25); // Random visitors per day

            for ($j = 0; $j < $count; $j++) {
                $visitors[] = [
                    'ip_address' => '192.168.1.'.rand(1, 255),
                    'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36',
                    'url' => '/',
                    'referer' => null,
                    'session_id' => 'session_'.rand(1000, 9999),
                    'visited_at' => $date->copy()->addMinutes(rand(0, 1439)), // Random time during the day
                    'created_at' => $date->copy()->addMinutes(rand(0, 1439)),
                    'updated_at' => $date->copy()->addMinutes(rand(0, 1439)),
                ];
            }
        }

        \App\Models\Visitor::insert($visitors);
    }
}
