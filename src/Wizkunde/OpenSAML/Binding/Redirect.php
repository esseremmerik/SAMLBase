<?php

namespace Wizkunde\OpenSAML\Binding;

use Wizkunde\OpenSAML\Binding\BindingAbstract;
use Wizkunde\OpenSAML\Template\AuthnRequest as RequestTemplate;

class Redirect extends BindingAbstract
{
    protected $request = '';

    protected $configuration = null;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function request()
    {
        $redirectUrl = $this->buildRedirectUrl();
    }

    protected function buildRedirectUrl()
    {
       return new RequestTemplate($this->configuration);
    }
}