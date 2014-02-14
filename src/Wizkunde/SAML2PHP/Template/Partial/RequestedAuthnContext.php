<?php

namespace Wizkunde\SAML2PHP\Template\Partial;

/**
 * Class Request
 *
 * Template for the AuthnRequest
 *
 * @package Wizkunde\SAML2PHP\Template
 */
class RequestedAuthnContext extends DOMDocument
{
    public function __construct($comparisonLevel, $version = '1.0', $encoding = 'UTF-8')
    {
        parent::__construct($version, $encoding);

        $rootElement = $this->createElementNS('urn:oasis:names:tc:SAML:2.0:protocol', 'samlp:RequestedAuthnContext', '');

        // Create the Format
        $comparisonAttribute = $this->document->createAttribute('Comparison');
        $comparisonAttribute->value = $comparisonLevel;
        $rootElement->appendChild($comparisonAttribute);

        $subElement = $rootElement->createElementNS('urn:oasis:names:tc:SAML:2.0:assertion', 'saml:AuthnContextClassRef', 'urn:oasis:names:tc:SAML:2.0:ac:classes:PasswordProtectedTransport');
        $rootElement->appendChild($subElement);

        $this->appendChild($rootElement);
    }
}
