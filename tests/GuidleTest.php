<?php

namespace Maidmaid\Guilde\Guidle;

use Maidmaid\Guidle\Guidle;

class GuidleTest extends PHPUnit_Framework_TestCase
{
    public function testConstructor()
    {
        $guidle = $this->getMockBuilder(Guidle::class)->disableOriginalConstructor();
    }
}
