<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Blade;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);

        Blade::directive('timeFormat', function($expression) {
            return "<?php echo with($expression)->format('h:i A'); ?>";
        });

        Blade::directive('dateFormat', function($expression) {
            return "<?php echo with($expression)->format('M-j-Y'); ?>";
        });

        Blade::directive('dateTimeFormat', function($expression) {
            return "<?php echo with($expression)->format('M-j-Y h:i A'); ?>";
        });

        Blade::directive('money', function($expression) {
            return "P <?php echo number_format($expression, 2); ?>";
        });
    }
}
