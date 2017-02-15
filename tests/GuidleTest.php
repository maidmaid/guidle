<?php

namespace Maidmaid\Guilde\Guidle;

use Maidmaid\Guidle\Guidle;
use PHPUnit\Framework\TestCase;

class GuidleTest extends TestCase
{
    public function testConstructor()
    {
        $guidle = $this->getMockBuilder(Guidle::class)->disableOriginalConstructor();
    }
}
