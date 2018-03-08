<?php

/**
 * File test.php
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    ${NAMESPACE}
 * @subpackage test.php
 * @author     Sujit Baniya <s.baniya.np@gmail.com>
 * @copyright  2018 @ Sujit Baniya. All rights reserved.
 */

use Sujit\Api\Response\Response;

require_once 'vendor/autoload.php';

$response = new Response();
echo $response->asJson();