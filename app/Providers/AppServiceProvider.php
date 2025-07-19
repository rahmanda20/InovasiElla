<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
// use Illuminate\Filesystem\Filesystem; // Only keep this if you directly use Filesystem class in this file, otherwise remove.

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * This method should be empty or contain only your *custom* bindings.
     * Laravel automatically registers 'files' for you.
     */
    public function register(): void
    {
        // Pastikan blok ini KOSONG atau hanya berisi binding kustom Anda yang lain.
        // Hapus baris ini jika ada: $this->app->singleton('files', ...);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Prevent error during composer install (important for production/deployment)
        if ($this->app->runningInConsole() && !$this->app->runningUnitTests()) {
            return;
        }

        // Only run if blade.compiler is available
        if ($this->app->bound('blade.compiler')) {
            Blade::directive('terbilang', function ($expression) {
                return "<?php echo \\App\\Http\\Controllers\\RabController::terbilangHelper($expression); ?>";
            });
        }
    }
}