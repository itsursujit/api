<?php namespace Sujit\Api\Auth\Models;

/**
 * File ApiKeyable.php
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    Sujit\Api\Auth\Models
 * @subpackage ApiKeyable.php
 * @author     Sujit Baniya <s.baniya.np@gmail.com>
 * @copyright  2018 @ Sujit Baniya. All rights reserved.
 */


/**
 * Class ApiKeyable
 *
 * @package    Sujit\Api\Auth\Models;
 * @subpackage ApiKeyable
 * @author     Sujit Baniya <s.baniya.np@gmail.com>
 */
trait ApiKeyable
{
    /**
     *
     * @author Sujit Baniya <s.baniya.np@gmail.com>
     *
     * @return mixed
     */
    public function apiKeys()
    {
        return $this->morphMany(config('apiauth.models.api_key', ApiKey::class), 'apikeyable');
    }

    /**
     *
     * @author Sujit Baniya <s.baniya.np@gmail.com>
     *
     * @return ApiKey
     */
    public function createApiKey()
    {
        return ApiKey::make($this);
    }
}