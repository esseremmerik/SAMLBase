<?php

namespace Wizkunde\OpenSAML\Configuration;

class UniqueID
{
    protected $prefix = 'OpenSAML';

    protected $uniqueID = '';

    public function __construct()
    {
        $this->uniqueID = $this->prefix . sha1(uniqid(mt_rand(), TRUE));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->uniqueID;
    }
}
