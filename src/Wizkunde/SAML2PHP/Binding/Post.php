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
    /**
     * The location in the metadata that has the current bindings information
     * @var string
     */
    protected $metadataBindingLocation = 'SSOPOST';

    /**
     * Do a request with the current binding
     */
    public function request()
    {
        parent::request();

        $this->getConfiguration()->set('ProtocolBinding', self::BINDING_POST);

        echo '<html><head></head><body onload="document.postform.submit();">';
        $form = $this->buildPostForm($this->getTargetUrl());
        echo $form;
        echo '</body></html>';
        exit;

        header('Location: ' . (string)$redirectUrl);
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
        $requestTemplate = new RequestTemplate('AuthnRequest', $this->getConfiguration());

        $deflatedRequest = gzdeflate($requestTemplate);
        $base64Request = base64_encode($deflatedRequest);
        $encodedRequest = urlencode($base64Request);

        return $encodedRequest;
    }
}
