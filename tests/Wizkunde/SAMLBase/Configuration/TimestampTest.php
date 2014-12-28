<?php

namespace Wizkunde\SAMLBase\Configuration;

use Wizkunde\SAMLBase\Configuration\Timestamp;
use Wizkunde\SAMLBase\Configuration;

class TimestampTest extends \PHPUnit_Framework_TestCase
{
    protected $timestamp;
    protected $time;

    public function setUp()
    {
        $this->time = time();
        $this->timestamp = new Timestamp($this->time);
    }

    public function testIfTimestampIsProperlyGenerated()
    {
        $this->assertRegExp('/(\d{4})-(\d{2})-(\d{2})T(\d{2}):(\d{2}):(\d{2})Z/', (string)$this->timestamp);
    }

    public function testIfItsPossibleToAddToTimestamp()
    {
       $this->timestamp->add(600);
       $this->assertEquals($this->timestamp->toTimestamp(), $this->time + 600);
    }
}