<?php

namespace Wizkunde\SAML2PHP\Binding;

use Wizkunde\SAML2PHP\Binding\BindingInterface;
use Wizkunde\SAML2PHP\ConfigurationTrait;

abstract class BindingAbstract implements BindingInterface
{
    // Allow the use of configuration
    use ConfigurationTrait;

    /**
     * Do a request with the current binding
     */
    public function request()
    {
    }
}
