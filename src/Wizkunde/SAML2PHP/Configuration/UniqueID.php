<?php

namespace Wizkunde\SAML2PHP\Configuration;

/**
 * Class UniqueID
 * @package Wizkunde\SAML2PHP\Configuration
 */
class UniqueID
{
    /**
     * @var string
     */
    protected $prefix = 'SAML2PHP';

    /**
     * @param string $prefix
     * @return string
     */
    public function generate($prefix = 'SAML2PHP')
    {
        $this->setPrefix($prefix);

        return $this->prefix . sha1(uniqid(mt_rand(), true));
    }

    /**
     * @return string
     */
    public function getPrefix()
    {
        return $this->prefix;
    }

    /**
     * @param string $prefix
     */
    public function setPrefix($prefix)
    {
        $this->prefix = $prefix;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->uniqueID;
    }
}
