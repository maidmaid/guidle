<?php

namespace Maidmaid\Guilde\Guidle;

use Maidmaid\Guidle\Guidle;

class GuidleTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $guidle = new Guidle('http://www.guidle.com/fr');
    }
}
