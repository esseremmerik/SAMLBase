<?php

namespace Wizkunde\SAML2PHP\Binding;

use Wizkunde\SAML2PHP\Binding\BindingAbstract;
use Wizkunde\SAML2PHP\Configuration;
use Wizkunde\SAML2PHP\Security\Signature;
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
    /**
     * The location in the metadata that has the current bindings information
     * @var string
     */
    protected $metadataBindingLocation = 'SSORedirect';

    /**
     * Do a request with the current binding
     */
    public function request()
    {
        parent::request();

        $this->getConfiguration()->set('ProtocolBinding', self::BINDING_REDIRECT);

        $redirectUrl = $this->buildRedirectUrl();
        header('Location: ' . (string)$redirectUrl);
    }

    /**
     * Build the Redirect URL, using the template thats provided
     * @return RequestTemplate
     */
    protected function buildRedirectUrl()
    {
        $requestTemplate = new RequestTemplate('AuthnRequest', $this->getConfiguration());
        $this->addSignature($requestTemplate->getDocument()->documentElement);

        $deflatedRequest = gzdeflate($requestTemplate->getDocument()->saveXml());
        $base64Request = base64_encode($deflatedRequest);
        $encodedRequest = urlencode($base64Request);

        return $this->getTargetUrl() . '?SAMLRequest=' . $encodedRequest;
    }
}
