<?php namespace Sujit\Api\Auth\Providers;

/**
 * File ApiAuthServiceProvider.php
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    Sujit\Api\Auth\Providers
 * @subpackage ApiAuthServiceProvider.php
 * @author     Sujit Baniya <itsursujit@gmail.com>
 * @copyright  2018 Sujit Baniya. All rights reserved.
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
 * @author     Sujit Baniya <itsursujit@gmail.com>
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
        $this->publishMigrations();
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
    private function defineMiddleware(Router $router)
    {
        foreach ($this->middlewares as $name => $class) {
            if ( version_compare(app()->version(), '5.4.0') >= 0 ) {
                $router->aliasMiddleware($name, $class);
            } else {
                $router->middleware($name, $class);
            }
        }
    }
    private function publishMigrations()
    {
        $this->publishes([
            __DIR__ . '/../../../database/migrations/' => base_path('/database/migrations'),
        ], 'migrations');
    }
}