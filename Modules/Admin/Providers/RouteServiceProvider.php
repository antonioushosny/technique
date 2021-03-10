<?php

namespace Modules\Admin\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The module namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $moduleNamespace = 'Modules\Admin\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        // Route::middleware('web')
        //     ->namespace($this->moduleNamespace)
        //     ->group(module_path('Admin', '/Routes/web.php'));

        Route::group([
            'prefix'     => app()->getLocale(),
            'middleware' => 'web',
            'namespace'  => $this->moduleNamespace,
        ], function ($router) {
            require module_path('admin', 'Routes/web.php', 'app');
        });
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
            ->middleware('api')
            ->namespace($this->moduleNamespace)
            ->group(module_path('Admin', '/Routes/api.php'));

        // Route::group([
        //     'middleware' => 'api',
        //     'namespace'  => $this->namespace,
        //     'prefix'     => app()->getLocale() .'/api',
        // ], function ($router) {
        //     require module_path('admin', 'Routes/api.php', 'app');
        // });
    }
}
