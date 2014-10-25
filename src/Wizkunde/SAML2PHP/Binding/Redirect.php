<?php

namespace Wizkunde\SAML2PHP\Binding;

use Wizkunde\SAML2PHP\Binding\BindingAbstract;
use Wizkunde\SAML2PHP\Configuration;
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
     * The http carrier to carry the quest
     */
    protected $client = null;

    /**
     * Do a request with the current binding
     */
    public function request()
    {
        $redirectUrl = $this->buildRedirectUrl();
        header('Location: ' . (string)$redirectUrl);
    }


    /**
     * Build the Redirect URL, using the template thats provided
     * @return RequestTemplate
     */
    protected function buildRedirectUrl()
    {
        $this->getConfiguration()->setProtocolBinding('urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect');
        $requestTemplate = new RequestTemplate('AuthnRequest', $this->getConfiguration());

        $deflatedRequest = gzdeflate($requestTemplate);
        $base64Request = base64_encode($deflatedRequest);
        $encodedRequest = urlencode($base64Request);

        // @todo make this dynamic
        return 'http://idp.wizkunde.nl/simplesaml/saml2/idp/SSOService.php?SAMLRequest=' . $encodedRequest;
    }

    /**
     * Set the HTTP carrier client
     */
    public function setClient($client)
    {
        $this->client = $client;
    }

    /**
     * Get the HTTP carrier client
     */
    public function getClient()
    {
        return $this->client;
    }
}
