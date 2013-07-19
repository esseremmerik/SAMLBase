<?php

namespace Wizkunde\OpenSAML\Binding;

use Wizkunde\OpenSAML\Binding\BindingInterface;

abstract class BindingAbstract implements BindingInterface
{
    abstract protected function buildRequest();

    /**
     * Do a request with the current binding
     */
    public function request()
    {

    }
}