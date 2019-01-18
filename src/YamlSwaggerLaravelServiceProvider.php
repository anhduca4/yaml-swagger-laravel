<?php
namespace Enda\YamlSwaggerLaravel;

use Illuminate\Support\ServiceProvider;

class YamlSwaggerLaravelServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $viewPath = __DIR__.'/../resources/views';
        $this->loadViewsFrom($viewPath, 'yaml-swagger-laravel');

        $configPath = __DIR__.'/../config/swagger.php';
        if ($this->app->runningInConsole()) {
            $this->publishes([
                $configPath => config_path('swagger.php'),
            ], 'config');

            $this->publishes([
                $viewPath => config('swagger.paths.views', resource_path('views/vendor/swagger')),
            ], 'views');
            $this->publishes([__DIR__.'/../resources/assets' => public_path('vendor/laravel-swagger')], 'laravel-swagger-assets');
            $this->publishes([__DIR__.'/../documents/swagger_v1' => base_path('documents/swagger_v1')], 'laravel-swagger-documents');
        }
        //Include routes
        require __DIR__.'/routes.php';
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(
            \Enda\YamlSwaggerLaravel\Services\SwaggerServiceInterface::class,
            \Enda\YamlSwaggerLaravel\Services\Production\SwaggerService::class
        );
    }
}
