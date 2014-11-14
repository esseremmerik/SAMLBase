<?php

namespace Wizkunde\SAML2PHP\Template;

use Wizkunde\SAML2PHP\Template\Request;
use Wizkunde\SAML2PHP\Template\Partial\NameIDPolicy;
use Wizkunde\SAML2PHP\Template\Partial\RequestedAuthnContext;
use Wizkunde\SAML2PHP\Template\Partial\Issuer;
use Wizkunde\SAML2PHP\Configuration;

/**
 * Class Request
 *
 * Template for the AuthnRequest
 *
 * @package Wizkunde\SAML2PHP\Template
 */
class AuthnRequest extends Request
{
    public function __construct($type = 'AuthnRequest', Configuration $configuration)
    {
        parent::__construct('AuthnRequest', $configuration);

        $rootElement = $this->document->documentElement;

        $assertionAttribute = $this->document->createAttribute('AssertionConsumerServiceURL');
        $assertionAttribute->value = $this->getConfiguration()->get('SPReturnUrl');
        $rootElement->appendChild($assertionAttribute);

        // Add the issuer part
        $issuer = new Issuer($this->document, $this->getConfiguration());
        $rootElement->appendChild(
            $issuer->getNode()
        );

        // Add the NameIDPolicy
        $nameIdPolicy = new NameIDPolicy($this->document, $this->getConfiguration());
        $rootElement->appendChild(
            $nameIdPolicy->getNode()
        );

        $authnContext = new RequestedAuthnContext($this->document, $this->getConfiguration());
        $rootElement->appendChild(
            $authnContext->getNode()
        );
    }
}
