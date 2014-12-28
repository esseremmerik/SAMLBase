<?php

namespace Wizkunde\SAMLBase\Configuration;

use Wizkunde\SAMLBase\Configuration\UniqueID;
use Wizkunde\SAMLBase\Configuration;

class UniqueIDTest extends \PHPUnit_Framework_TestCase
{
    public function testIfUniqueIDIsRandomEnough()
    {
        $randomStrings = array();
        for($i=0;$i<100;$i++) {
            $randomStrings[] = new UniqueID();
        }

        // Test if the unique values are still 100
        $this->assertCount(100, array_unique($randomStrings));
    }
}