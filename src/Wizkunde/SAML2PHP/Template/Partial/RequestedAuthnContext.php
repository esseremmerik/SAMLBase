<?php

namespace Wizkunde\SAML2PHP\Template\Partial;

use Wizkunde\SAML2PHP\Configuration;
use Wizkunde\SAML2PHP\Template\Partial\PartialAbstract;

/**
 * Class Request
 *
 * Template for the AuthnRequest
 *
 * @package Wizkunde\SAML2PHP\Template
 */
class RequestedAuthnContext extends PartialAbstract
{
    public function __construct(\DOMDocument $document, Configuration $configuration)
    {
        $this->node = $document->createElementNS('urn:oasis:names:tc:SAML:2.0:protocol', 'samlp:RequestedAuthnContext', '');

        $this->node->setAttribute('Comparison', $configuration->get('ComparisonLevel'));

        $subElement = $document->createElementNS('urn:oasis:names:tc:SAML:2.0:assertion', 'saml:AuthnContextClassRef', 'urn:oasis:names:tc:SAML:2.0:ac:classes:PasswordProtectedTransport');
        $this->node->appendChild($subElement);
    }
}
