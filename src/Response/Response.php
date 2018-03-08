<?php namespace Sujit\Api\Response;

/**
 * File Response.php
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    Sujit\Api
 * @subpackage Response.php
 * @author     Sujit Baniya <s.baniya.np@gmail.com>
 * @copyright  2018 @ Sujit Baniya. All rights reserved.
 */

use Sujit\Api\Response\Interfaces\ApiResponseInterface;
use Zend\Diactoros\MessageTrait;


/**
 * Class Response
 *
 * @package    Sujit\Api;
 * @subpackage Response
 * @author     Sujit Baniya <s.baniya.np@gmail.com>
 */
class Response implements ApiResponseInterface, \JsonSerializable
{
    use MessageTrait;

    private $data;

    private $success;

    private $error;

    private $pagination;

    private $dateTime;

    public function __construct($data = null, $pagination = null)
    {
        $this->data = $data;
        $this->pagination = $pagination;
        if($data) {
            $this->success = true;
            $this->error = false;
        }
        $this->dateTime = new \DateTime();
    }

    /**
     * Gets the response status code.
     *
     * The status code is a 3-digit integer result code of the server's attempt
     * to understand and satisfy the request.
     *
     * @return int Status code.
     */
    public function getStatusCode()
    {
        // TODO: Implement getStatusCode() method.
    }

    /**
     * Return an instance with the specified status code and, optionally, reason phrase.
     *
     * If no reason phrase is specified, implementations MAY choose to default
     * to the RFC 7231 or IANA recommended reason phrase for the response's
     * status code.
     *
     * This method MUST be implemented in such a way as to retain the
     * immutability of the message, and MUST return an instance that has the
     * updated status and reason phrase.
     *
     * @link http://tools.ietf.org/html/rfc7231#section-6
     * @link http://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml
     *
     * @param int $code            The 3-digit integer result code to set.
     * @param string $reasonPhrase The reason phrase to use with the
     *                             provided status code; if none is provided, implementations MAY
     *                             use the defaults as suggested in the HTTP specification.
     *
     * @return static
     * @throws \InvalidArgumentException For invalid status code arguments.
     */
    public function withStatus($code, $reasonPhrase = '')
    {
        // TODO: Implement withStatus() method.
    }

    /**
     * Gets the response reason phrase associated with the status code.
     *
     * Because a reason phrase is not a required element in a response
     * status line, the reason phrase value MAY be null. Implementations MAY
     * choose to return the default RFC 7231 recommended reason phrase (or those
     * listed in the IANA HTTP Status Code Registry) for the response's
     * status code.
     *
     * @link http://tools.ietf.org/html/rfc7231#section-6
     * @link http://www.iana.org/assignments/http-status-codes/http-status-codes.xhtml
     * @return string Reason phrase; must return an empty string if none present.
     */
    public function getReasonPhrase()
    {
        // TODO: Implement getReasonPhrase() method.
}

    public function withSuccess($data)
    {
        $this->data = $data;
        $this->success = true;
        $this->pagination = null;
        $this->error = false;

        return $this;

    }

    public function withException($data)
    {
        $this->data = null;
        $this->success = false;
        $this->pagination = null;
        $this->error = $data;

        return $this;
    }

    public function withPaginatedSuccess($data, $pagination)
    {
        $this->data = $data;
        $this->success = true;
        $this->pagination = $pagination;
        $this->error = false;

        return $this;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link  http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize()
    {
        $vars = get_object_vars($this);

        return $vars;
    }

    public function asJson()
    {
        header('Content-Type: application/json');
        return json_encode($this);
    }
}