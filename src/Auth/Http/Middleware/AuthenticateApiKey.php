<?php namespace Sujit\Api\Auth\Http\Middleware;

/**
 * File AuthenticateApiKey.php
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    Sujit\Api\Auth\Http\Middleware
 * @subpackage AuthenticateApiKey.php
 * @author     Sujit Baniya <itsursujit@gmail.com>
 * @copyright  2018 @ Sujit Baniya. All rights reserved.
 */

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Sujit\Api\Auth\Events\ApiKeyAuthenticated;
use Sujit\Api\Auth\Models\ApiKey;
use Sujit\Api\Response\Response;


/**
 * Class AuthenticateApiKey
 *
 * @package    Sujit\Api\Auth\Http\Middleware;
 * @subpackage AuthenticateApiKey
 * @author     Sujit Baniya <itsursujit@gmail.com>
 */
class AuthenticateApiKey
{

    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param Closure $next
     * @param  string|null $guard
     *
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $guard = null)
    {
        $apiKeyValue = $request->header('Authorization');

        //Get API_KEY from header
        if ( ! empty($apiKeyValue)) {
            $bearer      = explode(' ', $apiKeyValue);
            $apiKeyValue = $bearer[1];
        } else {
            $apiKeyValue = $request->get('api_key');
        }

        if(empty($apiKeyValue)) {
            return $this->error404Response();
        }

        $apiKey = app(ApiKey::class)->where('key', $apiKeyValue)
                                    ->first();
        if (empty($apiKey)) {
            return $this->unauthorizedResponse();
        }

        // Update this api key's last_used_at and last_ip_address
        $apiKey->update([
            'last_used_at'    => Carbon::now(),
            'last_ip_address' => $request->ip(),
        ]);

        $apikeyable = $apiKey->apikeyable;

        // Bind the user or object to the request
        // By doing this, we can now get the specified user through the request object in the controller using:
        // $request->user()
        $request->setUserResolver(function () use ($apikeyable) {
            return $apikeyable;
        });

        // Attach the apikey object to the request
        $request->apiKey = $apiKey;
        //Trigger event on successful API Authentication
        event(new ApiKeyAuthenticated($request, $apiKey));

        return $next($request);
    }

    protected function unauthorizedResponse()
    {
        return response([
            'error' => [
                'code'    => 401,
                'message' => 'Unauthorized.',
            ],
        ], 401);
    }

    protected function error404Response()
    {
        return response([
            'error' => [
                'code'    => 404,
                'message' => 'API Key Not Found.',
            ],
        ], 404);
    }

}