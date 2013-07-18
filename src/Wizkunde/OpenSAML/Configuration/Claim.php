<?php

namespace Wizkunde\OpenSAML\Configuration;

use Wizkunde\OpenSAML\Configuration\ClaimInterface;

class Claim implements ClaimInterface
{
    protected $_claimKey = '';
    protected $_claimValue = '';

    /**
     * Set the claim key that we retreived from the AuthRequest
     *
     * @param string $claimKey
     */
    public function setKey($claimKey)
    {
        $this->_claimKey = $claimKey;
    }

    /**
     * Get the claim key that we retreived from the AuthRequest
     *
     * @return string
     */
    public function getKey()
    {
        return $this->_claimKey;
    }

    /**
     * Set the claim value that we retreived from the AuthRequest
     *
     * @return mixed
     */
    public function getValue()
    {
        return $this->_claimValue;
    }

    /**
     * Set the claim value that we retreived from the AuthRequest
     *
     * @param string $claimValue
     */
    public function setValue($claimValue)
    {
        $this->_claimValue = $claimValue;
    }
}