<?php

namespace Wizkunde\OpenSAML\Binding;

use Wizkunde\OpenSAML\Binding\BindingInterface;
use Wizkunde\OpenSAML\ConfigurationTrait;

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
