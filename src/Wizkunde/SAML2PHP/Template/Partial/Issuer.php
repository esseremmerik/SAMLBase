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
class Issuer extends PartialAbstract
{
    public function __construct(\DOMDocument $document, Configuration $configuration)
    {
        $this->node = $document->createElementNS('urn:oasis:names:tc:SAML:2.0:assertion', 'saml:Issuer', $configuration->get('Issuer'));
    }
}
