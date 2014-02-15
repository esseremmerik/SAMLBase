<?php

namespace Wizkunde\SAML2PHP\Template;

use Wizkunde\SAML2PHP\Configuration;
use Wizkunde\SAML2PHP\Template\Partial\Metadata\SPSSODescriptor;
use Wizkunde\SAML2PHP\Template\TemplateAbstract;

class Metadata extends TemplateAbstract
{
    public function __construct($type = 'EntityDescriptor', Configuration $configuration)
    {
        parent::__construct($type, $configuration);

        $this->document = new \DOMDocument('1.0', "UTF-8");

        $rootElement = $this->document->createElementNS('urn:oasis:names:tc:SAML:2.0:metadata', 'md:' . $type, '');

        // Create the validUntil
        $this->getConfiguration()->getTimestamp()->add(Timestamp::SECONDS_WEEK);
        $validAttribute = $this->document->createAttribute('validUntil');
        $validAttribute->value = $this->getConfiguration()->getTimestamp();
        $rootElement->appendChild($validAttribute);

        // Create EntityID
        $entityAttribute = $this->document->createAttribute('entityID');
        $entityAttribute->value = $this->getConfiguration()->getIssuer();
        $rootElement->appendChild($entityAttribute);

        // Add the issuer part
        $descriptorNode = new SPSSODescriptor($this->document, $this->getConfiguration());
        $rootElement->appendChild(
            $descriptorNode->getNode()
        );

        $this->document->appendChild($rootElement);
    }
}
