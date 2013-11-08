<?php

namespace Wizkunde\OpenSAML\Configuration;

class Timestamp
{
    const SECONDS_MINUTE = 60;
    const SECONDS_HOUR   = 3600;
    const SECONDS_DAY    = 86400;
    const SECONDS_WEEK   = 604800;

    protected $timestamp = '';

    /**
     * @todo do this with the intl extension possibly?
     *
     * @return string Get a valid timestamp
     */
    public  function __construct()
    {
        $timeZone = date_default_timezone_get();
        date_default_timezone_set('UTC');
        $time = strftime("%Y-%m-%dT%H:%M:%SZ", time());
        date_default_timezone_set($timeZone);

        $this->timestamp = $time;
    }

    public function add($seconds = 0)
    {
        $this->timestamp = $this->timestamp + $seconds;
    }

    public function __toString()
    {
        return (string)$this->timestamp;
    }
}