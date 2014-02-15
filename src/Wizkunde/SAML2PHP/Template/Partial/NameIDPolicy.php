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
class NameIDPolicy extends PartialAbstract
{
    public function __construct(\DOMDocument $document, Configuration $configuration)
    {
        $this->node = $document->createElementNS('urn:oasis:names:tc:SAML:2.0:protocol', 'samlp:NameIDPolicy', '');
        $this->node->setAttribute('Format', $configuration->getNameIdFormat());
        $this->node->setAttribute('SPNameQualifier', $configuration->getIssuer());
        $this->node->setAttribute('AllowCreate', true);
    }
}
