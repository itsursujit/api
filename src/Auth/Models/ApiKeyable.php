<?php namespace Sujit\Api\Auth\Models;

/**
 * File ApiKeyable.php
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    Sujit\Api\Auth\Models
 * @subpackage ApiKeyable.php
 * @author     Sujit Baniya <itsursujit@gmail.com>
 * @copyright  2018 @ Sujit Baniya. All rights reserved.
 */


/**
 * Class ApiKeyable
 *
 * @package    Sujit\Api\Auth\Models;
 * @subpackage ApiKeyable
 * @author     Sujit Baniya <itsursujit@gmail.com>
 */
trait ApiKeyable
{
    /**
     *
     * @author Sujit Baniya <itsursujit@gmail.com>
     *
     * @return mixed
     */
    public function apiKeys()
    {
        return $this->morphMany(ApiKey::class, 'apikeyable');
    }

    /**
     *
     * @author Sujit Baniya <itsursujit@gmail.com>
     *
     * @return ApiKey
     */
    public function createApiKey()
    {
        return ApiKey::make($this);
    }
}