<?php

namespace Wizkunde\SAML2PHP\Binding;

use Wizkunde\SAML2PHP\Binding\BindingAbstract;
use Wizkunde\SAML2PHP\Configuration;
use Wizkunde\SAML2PHP\Template\AuthnRequest as RequestTemplate;

/**
 * Class Redirect
 *
 * POST binding that uses HTTP-POST as a transport for a SAML request
 *
 * @package Wizkunde\SAML2PHP\Binding
 */
class Post extends BindingAbstract
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
        // Todo make dynamic, by resolving metadata
        $url = 'http://idp.wizkunde.nl/simplesaml/saml2/idp/SSOService.php';

        echo '<html><head></head><body onload="document.postform.submit();">';
        $form = $this->buildPostForm($url);
        echo $form;
        echo '</body></html>';
        exit;
    }

    protected function buildPostForm($url = '')
    {
        $form = '<form method="POST" action="' . $url . '" name="postform">';
        $form .= '<input type="hidden" name="SAMLRequest" value=" ' . $this->buildPostRequest() . '">';
        $form .= '</form>';

        return $form;
    }

    /**
     * Build the SAML Request, using the template thats provided
     * @return RequestTemplate
     */
    protected function buildPostRequest()
    {
        $this->getConfiguration()->setProtocolBinding('urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST');
        $requestTemplate = new RequestTemplate('AuthnRequest', $this->getConfiguration());

        $deflatedRequest = gzdeflate($requestTemplate);
        $base64Request = base64_encode($deflatedRequest);
        $encodedRequest = urlencode($base64Request);

        return $encodedRequest;
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
