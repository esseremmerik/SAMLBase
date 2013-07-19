<?php

namespace Wizkunde\OpenSAML\Binding;

use Wizkunde\OpenSAML\Binding\BindingInterface;

abstract class BindingAbstract implements BindingInterface
{
    /**
     * Do a request with the current binding
     */
    public function request()
    {
    }
}