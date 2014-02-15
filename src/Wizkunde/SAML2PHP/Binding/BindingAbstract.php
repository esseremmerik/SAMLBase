<?php

namespace Wizkunde\SAML2PHP\Binding;

use Wizkunde\SAML2PHP\Binding\BindingInterface;
use Wizkunde\SAML2PHP\ConfigurationTrait;

abstract class BindingAbstract implements BindingInterface
{
    // Allow the use of configuration
    use ConfigurationTrait;

    /**
     * @var bool debug set to true will not compress the output
     */
    protected $debug = false;

    /**
     * @param bool $debug Enable debugging of the binding
     */
    public function setDebug($debug = false) {
        $this->debug = $debug;
    }

    /**
     * Do a request with the current binding
     */
    public function request()
    {
    }
}
