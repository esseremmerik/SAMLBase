<?php

namespace Wizkunde\SAML2PHP\Template\Partial\Metadata;

use Wizkunde\SAML2PHP\Configuration;
use Wizkunde\SAML2PHP\Template\Partial\PartialAbstract;

/**
 * Class Request
 *
 * Template for the AuthnRequest
 *
 * @package Wizkunde\SAML2PHP\Template
 */
class NameIDFormat extends PartialAbstract
{
    public function __construct(\DOMDocument $document, Configuration $configuration)
    {
        $this->node = $document->createElement('md:NameIDFormat', $configuration->getNameIdFormat());


    }
}
