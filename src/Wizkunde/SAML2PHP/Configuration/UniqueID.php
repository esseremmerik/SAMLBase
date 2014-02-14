<?php

namespace Wizkunde\SAML2PHP\Configuration;

class UniqueID
{
    protected $prefix = 'SAML2PHP';

    protected $uniqueID = '';

    public function __construct()
    {
        $this->uniqueID = $this->prefix . sha1(uniqid(mt_rand(), true));
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->uniqueID;
    }
}
