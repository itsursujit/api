<?php namespace Sujit\Api\Auth\Events;

/**
 * File ApiKeyAuthenticated.php
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    Sujit\Api\Auth\Events
 * @subpackage ApiKeyAuthenticated.php
 * @author     Sujit Baniya <itsursujit@gmail.com>
 * @copyright  2018 Sujit Baniya. All rights reserved.
 */

use Illuminate\Http\Request;
use Illuminate\Queue\SerializesModels;
use Sujit\Api\Auth\Models\ApiKey;

/**
 * Class ApiKeyAuthenticated
 *
 * @package   Sujit\Api\Auth\Events;
 * @subpackage ApiKeyAuthenticated
 * @author     Sujit Baniya <itsursujit@gmail.com>
 */
class ApiKeyAuthenticated
{
    use SerializesModels;
    public $request;
    public $apiKey;
    /**
     * Create a new event instance.
     *
     * @param Request $request
     * @param ApiKey $apiKey
     */
    public function __construct(Request $request, ApiKey $apiKey)
    {
        $this->request = $request;
        $this->apiKey = $apiKey;
    }
}