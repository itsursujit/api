<?php namespace Sujit\Api\Response\Interfaces;

/**
 * File ApiResponseInterface.php
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    Sujit\Api\Response\Interfaces
 * @subpackage ApiResponseInterface.php
 * @author     Sujit Baniya <itsursujit@gmail.com>
 * @copyright  2018 @ Sujit Baniya. All rights reserved.
 */

use Psr\Http\Message\ResponseInterface;


/**
 * Interface ApiResponseInterface
 *
 * @package    Sujit\Api\Response\Interfaces;
 * @subpackage ApiResponseInterface
 * @author     Sujit Baniya <itsursujit@gmail.com>
 */
interface ApiResponseInterface extends ResponseInterface
{
    public function withSuccess($data);

    public function withException($data);

    public function withPaginatedSuccess($data, $pagination);
}