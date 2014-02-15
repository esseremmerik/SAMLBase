<?php

namespace Wizkunde\SAML2PHP\Template\Partial\Metadata;

use Wizkunde\SAML2PHP\Configuration;
use Wizkunde\SAML2PHP\Template\Partial\PartialAbstract;
use Wizkunde\SAML2PHP\Template\Partial\Metadata\NameIDFormat;
use Wizkunde\SAML2PHP\Template\Partial\Metadata\AssertionConsumerService;


/**
 * Class Request
 *
 * Template for the AuthnRequest
 *
 * @package Wizkunde\SAML2PHP\Template
 */
class SPSSODescriptor extends PartialAbstract
{
    public function __construct(\DOMDocument $document, Configuration $configuration)
    {
        $this->node = $document->createElement('md:SPSSODescriptor', '');
        $this->node->setAttribute('protocolSupportEnumeration', 'urn:oasis:names:tc:SAML:2.0:protocol');

        // Add the issuer part
        $formatNode = new NameIDFormat($this->document, $this->getConfiguration());
        $this->node->appendChild(
            $formatNode->getNode()
        );

        // Add the issuer part
        $acsNode = new AssertionConsumerService($this->document, $this->getConfiguration());
        $this->node->appendChild(
            $acsNode->getNode()
        );
    }
}
