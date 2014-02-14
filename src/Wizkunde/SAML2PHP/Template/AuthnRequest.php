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


        $rootElement = $this->document->getElementById('samlp:AuthnRequest');

        $assertionAttribute = $this->document->createAttribute('AssertionConsumerServiceURL');
        $assertionAttribute->value = $this->getConfiguration()->getSpReturnURL();
        $rootElement->appendChild($assertionAttribute);

        // Add the issuer part
        $rootElement->appendChild(
            new Issuer(
                $this->getConfiguration()->getIssuer()
            )
        );

        // Add the NameIDPolicy
        $rootElement->appendChild(
            new NameIDPolicy(
                $this->getConfiguration()->getNameIdFormat(),
                $this->getConfiguration()->getIssuer()
            )
        );

        $rootElement->appendChild(
            new RequestedAuthnContext(
                $this->getConfiguration()->getComparisonLevel()
            )
        );
    }
}
