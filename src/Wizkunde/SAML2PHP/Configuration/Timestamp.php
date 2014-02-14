<?php

namespace Wizkunde\SAML2PHP\Configuration;

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
    public function __construct($time = null)
    {
        if ($time === null) {
            $time = time();
        }

        $this->timestamp = new \DateTime();
        $this->timestamp->setTimestamp($time);

        $UTC = new \DateTimeZone("UTC");
        $this->timestamp->setTimezone($UTC);
    }

    public function getDate()
    {
        return $this->timestamp;
    }

    public function add($seconds = 0)
    {
        $dateInterval = new \DateInterval('PT' . $seconds . 'S');
        $this->timestamp->add($dateInterval);
    }

    public function toTimestamp()
    {
        return $this->timestamp->getTimestamp();
    }

    public function __toString()
    {
        return $this->timestamp->format('Y-m-d\TH:i:s\Z');
    }
}
