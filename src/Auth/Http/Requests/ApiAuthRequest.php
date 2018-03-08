<?php namespace Sujit\Api\Auth\Http\Requests;
/**
 * File ApiAuthRequest.php
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    ${NAMESPACE}
 * @subpackage ApiAuthRequest.php
 * @author     Sujit Baniya <s.baniya.np@gmail.com>
 * @copyright  2018 @ Sujit Baniya. All rights reserved.
 */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Sujit\Api\Response\Response;


/**
 * Class ApiAuthRequest
 *
 * @subpackage ApiAuthRequest
 * @author     Sujit Baniya <s.baniya.np@gmail.com>
 */
class ApiAuthRequest extends Request
{
    public function expectsJson()
    {
        return true;
    }
    /**
     * Format the errors from the given Validator instance.
     *
     * @param  \Illuminate\Contracts\Validation\Validator $validator
     * @return array
     */
    protected function formatErrors(Validator $validator)
    {
        return $validator->getMessageBag()->toArray();
    }
    public function response(array $errors)
    {
        $response = new Response();
        return $response->withException($errors);
    }
}