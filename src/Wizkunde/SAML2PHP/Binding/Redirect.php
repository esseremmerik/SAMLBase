<?php

namespace Wizkunde\SAMLBase\Binding;

/**
 * Class Redirect
 *
 * Redirect binding that uses HTTP-GET as a transport for a SAML request
 *
 * @package Wizkunde\SAMLBase\Binding
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
    public function request($requestType = 'AuthnRequest')
    {
        parent::request();

        $this->setProtocolBinding(self::BINDING_REDIRECT);

        header('Location: ' . (string)$this->getTargetUrl() . '?SAMLRequest=' . $this->buildRequest($requestType));
    }
}
