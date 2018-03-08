<?php namespace Sujit\Api\Auth\Providers;

/**
 * File ApiAuthServiceProvider.php
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    Sujit\Api\Auth\Providers
 * @subpackage ApiAuthServiceProvider.php
 * @author     Sujit Baniya <sujit@kvsocial.com>
 * @copyright  2018 Instasuite.com. All rights reserved.
 */

use Illuminate\Routing\Router;
use Illuminate\Support\ServiceProvider;
use Sujit\Api\Auth\Console\Commands\GenerateApiKey;
use Sujit\Api\Auth\Http\Middleware\AuthenticateApiKey;

/**
 * Class ApiAuthServiceProvider
 *
 * @package   Sujit\Api\Auth\Providers;
 * @subpackage ApiAuthServiceProvider
 * @author     Sujit Baniya <sujit@kvsocial.com>
 */
class ApiAuthServiceProvider extends ServiceProvider
{
    protected $middlewares = [
        'auth.apikey' => AuthenticateApiKey::class,
    ];
    /**
     * Bootstrap the application services.
     *
     * @param Router $router
     * @return void
     */
    public function boot(Router $router)
    {
        // Publish migrations
        $this->publishFiles();
        $this->defineMiddleware($router);
    }
    /** /
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->commands([
            GenerateApiKey::class,
        ]);
    }
    private function defineMiddleware($router)
    {
        foreach ($this->middlewares as $name => $class) {
            if ( version_compare(app()->version(), '5.5.0') >= 0 ) {
                $router->aliasMiddleware($name, $class);
            } else {
                $router->middleware($name, $class);
            }
        }
    }
    private function publishFiles()
    {
        $this->publishes([
            __DIR__ . '/../../../database/migrations/' => base_path('/database/migrations'),
        ], 'migrations');
        $this->publishes([
            __DIR__ . '/../../../config/apiauth.php' => config_path('apiauth.php'),
        ], 'config');
    }
}