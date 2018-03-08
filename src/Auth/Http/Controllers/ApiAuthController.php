<?php namespace Sujit\Api\Auth\Http\Controllers;

/**
 * File ApiAuthController.php
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    Sujit\Api\ApiAuth\Http\Controllers
 * @subpackage ApiAuthController.php
 * @author     Sujit Baniya <s.baniya.np@gmail.com>
 * @copyright  2018 @ Sujit Baniya. All rights reserved.
 */
use Illuminate\Routing\Controller;
use Sujit\Api\Response\Response;

/**
 * Class ApiAuthController
 *
 * @package    Sujit\Api\ApiAuth\Http\Controllers;
 * @subpackage ApiAuthController
 * @author     Sujit Baniya <s.baniya.np@gmail.com>
 */
class ApiAuthController extends Controller
{
    protected $response;

    public function __construct()
    {
        $this->response = new Response();
    }
}