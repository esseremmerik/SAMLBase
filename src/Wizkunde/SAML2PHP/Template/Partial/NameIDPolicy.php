<?php

namespace Wizkunde\SAML2PHP\Template\Partial;

/**
 * Class Request
 *
 * Template for the AuthnRequest
 *
 * @package Wizkunde\SAML2PHP\Template
 */
class NameIDPolicy extends DOMDocument
{
    public function __construct($nameIdFormat, $issuer, $version = '1.0', $encoding = 'UTF-8')
    {
        parent::__construct($version, $encoding);

        $rootElement = $this->createElementNS('urn:oasis:names:tc:SAML:2.0:protocol', 'samlp:NameIDPolicy', '');

        // Create the Format
        $formatAttribute = $this->document->createAttribute('Format');
        $formatAttribute->value = $nameIdFormat;
        $rootElement->appendChild($formatAttribute);

        $qualifierAttribute = $this->document->createAttribute('SPNameQualifier');
        $qualifierAttribute->value = $issuer;
        $rootElement->appendChild($qualifierAttribute);

        $createAttribute = $this->document->createAttribute('AllowCreate');
        $createAttribute->value = true;
        $rootElement->appendChild($createAttribute);

        $this->appendChild($rootElement);
    }
}
