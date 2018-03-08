<?php namespace Sujit\Api\Auth\Models;

/**
 * File ApiKey.php
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    Sujit\Api\Auth\Models
 * @subpackage ApiKey.php
 * @author     Sujit Baniya <itsursujit@gmail.com>
 * @copyright  2018 @ Sujit Baniya. All rights reserved.
 */

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Request;


/**
 * Class ApiKey
 *
 * @package    Sujit\Api\Auth\Models;
 * @subpackage ApiKey
 * @author     Sujit Baniya <itsursujit@gmail.com>
 */
class ApiKey extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'key',
        'apikeyable_id',
        'apikeyable_type',
        'last_ip_address',
        'last_used_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function apikeyable()
    {
        return $this->morphTo();
    }

    /**
     * @param $apikeyable
     *
     * @return ApiKey
     */
    public static function make($apikeyable)
    {
        $apiKey = new ApiKey([
            'key'              => self::generateKey(),
            'apikeyable_id'    => $apikeyable->id,
            'apikeyable_model' => get_class($apikeyable),
            'last_ip_address'  => Request::ip(),
            'last_used_at'     => Carbon::now(),
        ]);
        $apiKey->save();

        return $apiKey;
    }

    /**
     * method to generate a unique API key
     *
     * @return string
     */
    public static function generateKey()
    {
        do {
            $token = bin2hex(openssl_random_pseudo_bytes(32));
        } // Already in the DB? Fail. Try again
        while (self::keyExists($token));

        return $token;
    }

    /**
     * Checks whether a key exists in the database or not
     *
     * @param $key
     *
     * @return bool
     */
    private static function keyExists($key)
    {
        $apiKeyCount = self::where('key', '=', $key)->limit(1)->count();
        if ($apiKeyCount > 0) {
            return true;
        }

        return false;
    }
}