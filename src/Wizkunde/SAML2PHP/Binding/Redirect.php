<?php

namespace Wizkunde\SAML2PHP\Binding;

use Wizkunde\SAML2PHP\Binding\BindingAbstract;
use Wizkunde\SAML2PHP\Configuration\Timestamp;
use Wizkunde\SAML2PHP\Configuration\UniqueID;
use Wizkunde\SAML2PHP\Template\AuthnRequest as RequestTemplate;

/**
 * Class Redirect
 *
 * Redirect binding that uses HTTP-GET as a transport for a SAML request
 *
 * @package Wizkunde\SAML2PHP\Binding
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
        $requestTemplate = new RequestTemplate('AuthnRequest', $this->getConfiguration());

        return $requestTemplate;
    }
}
