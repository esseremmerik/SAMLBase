<?php

namespace Wizkunde\SAML2PHP\Template\Partial;

/**
 * Class Request
 *
 * Template for the AuthnRequest
 *
 * @package Wizkunde\SAML2PHP\Template
 */
class Issuer extends DOMDocument
{
    public function __construct($value, $version = '1.0', $encoding = 'UTF-8')
    {
        parent::__construct($version, $encoding);

        $rootElement = $this->createElementNS('urn:oasis:names:tc:SAML:2.0:assertion', 'saml:Issuer', $value);
        $this->appendChild($rootElement);
    }
}
