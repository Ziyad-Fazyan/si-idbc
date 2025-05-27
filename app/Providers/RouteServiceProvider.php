<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Cache\RateLimiting\Limit;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * Get the path to the application's "home" route based on user role.
     *
     * This method determines the appropriate home route based on user type.
     *
     * @return string
     */
    public static function home()
    {
        if (Auth::check()) {
            $user = Auth::user();
            Alert::info('Informasi', 'Saat ini kamu telah login sebagai ' . $user->name);
            
            switch ($user->rawtype) {
                case 0:
                    return '/web-admin/home';
                case 1:
                    return '/finance/home';
                case 2:
                    return '/absen/home';
                case 3:
                    return '/academic/home';
                case 4:
                    return '/musyrif/home';
                case 5:
                    return '/support/home';
                default:
                    return '/web-admin/home';
            }
        }
        
        return '/admin/auth-signin';
    }
    
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->routes(function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        });
    }
}
