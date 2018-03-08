<?php namespace Sujit\Test\Unit;

/**
 * File Base.php
 *
 * PHP version 7
 *
 * @category   PHP
 * @package    Sujit\Test\Unit
 * @subpackage Base.php
 * @author     Sujit Baniya <itsursujit@gmail.com>
 * @copyright  2018 @ Sujit Baniya. All rights reserved.
 */

use PHPUnit\Framework\TestCase;


/**
 * Class Base
 *
 * @package    Sujit\Test\Unit;
 * @subpackage Base
 * @author     Sujit Baniya <itsursujit@gmail.com>
 */

class Base extends TestCase
{
    protected function setUp()
    {
        parent::setUp(); // TODO: Change the autogenerated stub
    }
    protected function tearDown()
    {
        \Mockery::close();
        parent::tearDown(); // TODO: Change the autogenerated stub
    }
}