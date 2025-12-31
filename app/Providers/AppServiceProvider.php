<?php

namespace App\Providers;

use Illuminate\Foundation\Vite;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (! (bool) env('VITE_USE_HOT', false)) {
            app(Vite::class)->useHotFile(storage_path('app/vite.hot'));
        }

        $hotFile = public_path('hot');

        if (is_file($hotFile)) {
            $hotUrl = trim((string) file_get_contents($hotFile));

            if ($hotUrl !== '') {
                $hotParts = parse_url($hotUrl);
                $hotHost = $hotParts['host'] ?? 'localhost';
                $hotPort = (int) ($hotParts['port'] ?? 5173);

                $connection = @fsockopen($hotHost, $hotPort, $errno, $errstr, 0.15);

                if (is_resource($connection)) {
                    fclose($connection);
                } else {
                    app(Vite::class)->useHotFile(storage_path('app/vite.hot'));
                }
            }
        }

        // Register custom string helper for auto-formatting text
        if (! function_exists('auto_format_text')) {
            function auto_format_text($text)
            {
                if (empty($text)) {
                    return '';
                }

                // Clean up the text
                $text = trim($text);

                // Handle different types of line breaks
                $text = str_replace(["\r\n", "\r"], "\n", $text);

                // Split by double line breaks to create paragraphs
                $paragraphs = preg_split('/\n\s*\n/', $text);
                $formatted = [];

                foreach ($paragraphs as $paragraph) {
                    $paragraph = trim($paragraph);
                    if (! empty($paragraph)) {
                        // Replace single line breaks with spaces
                        $paragraph = str_replace("\n", ' ', $paragraph);

                        // Capitalize first letter
                        $paragraph = ucfirst($paragraph);

                        // Capitalize after periods
                        $paragraph = preg_replace_callback('/\. (\w)/', function ($matches) {
                            return '. '.ucfirst($matches[1]);
                        }, $paragraph);

                        $formatted[] = '<p class="mb-4">'.$paragraph.'</p>';
                    }
                }

                return implode('', $formatted);
            }
        }
    }
}

if (! function_exists(__NAMESPACE__.'\\public_cache')) {
    function public_cache()
    {
        $defaultStore = (string) config('cache.default', 'file');

        return $defaultStore === 'database'
            ? Cache::store('file')
            : Cache::store($defaultStore);
    }
}

if (! function_exists(__NAMESPACE__.'\\public_cache_forget')) {
    function public_cache_forget(string $key): void
    {
        Cache::forget($key);
        Cache::store('file')->forget($key);
    }
}
