<?php

namespace Wizkunde\OpenSAML\Binding;

use Wizkunde\OpenSAML\Binding\BindingAbstract;
use Wizkunde\OpenSAML\Configuration\Timestamp;
use Wizkunde\OpenSAML\Configuration\UniqueID;
use Wizkunde\OpenSAML\Template\AuthnRequest as RequestTemplate;

/**
 * Class Redirect
 *
 * Redirect binding that uses HTTP-GET as a transport for a SAML request
 *
 * @package Wizkunde\OpenSAML\Binding
 */
class Redirect extends BindingAbstract
{
    protected $request = '';

    /**
     * Do a request with the current binding
     */
    public function request()
    {
        $redirectUrl = $this->buildRedirectUrl();

        return (string)$redirectUrl;
    }

    /**
     * Build the Redirect URL, using the template thats provided
     * @return RequestTemplate
     */
    protected function buildRedirectUrl()
    {
        $requestTemplate = new RequestTemplate(new UniqueID(), new Timestamp());
        $requestTemplate->setConfiguration($this->getConfiguration());

        return $requestTemplate;
    }
}
