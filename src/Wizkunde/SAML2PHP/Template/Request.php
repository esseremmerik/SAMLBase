<?php

namespace Wizkunde\SAML2PHP\Template;

use Wizkunde\SAML2PHP\Configuration;
use Wizkunde\SAML2PHP\Template\TemplateAbstract;

/**
 * Class Request
 *
 * Template for the AuthnRequest
 *
 * @package Wizkunde\SAML2PHP\Template
 */
class Request extends TemplateAbstract
{
    public function __construct($type = 'AuthnRequest', Configuration $configuration)
    {
        parent::__construct($type, $configuration);

        $this->document = new \DOMDocument('1.0', "UTF-8");

        $rootElement = $this->document->createElementNS('urn:oasis:names:tc:SAML:2.0:protocol', 'samlp:' . $type, '');

        // Create the Unique ID
        $idAttribute = $this->document->createAttribute('ID');
        $idAttribute->value = $this->getConfiguration()->get('UniqueID');
        $rootElement->appendChild($idAttribute);

        // Create the Version
        $versionAttribute = $this->document->createAttribute('Version');
        $versionAttribute->value = "2.0";
        $rootElement->appendChild($versionAttribute);

        // Create the IssueInstant
        $issueInstantAttribute = $this->document->createAttribute('IssueInstant');
        $issueInstantAttribute->value = $this->getConfiguration()->get('Timestamp');
        $rootElement->appendChild($issueInstantAttribute);

        // Create ForceAuthn (force reauthentication)
        $forceAttribute = $this->document->createAttribute('ForceAuthn');
        $forceAttribute->value = $this->getConfiguration()->get('ForceAuthn');
        $rootElement->appendChild($forceAttribute);

        // Create IsPassive
        $passiveAttribute = $this->document->createAttribute('IsPassive');
        $passiveAttribute->value = $this->getConfiguration()->get('IsPassive');
        $rootElement->appendChild($passiveAttribute);

        $bindingAttribute = $this->document->createAttribute('ProtocolBinding');
        $bindingAttribute->value = $this->getConfiguration()->get('ProtocolBinding');
        $rootElement->appendChild($bindingAttribute);

        $this->document->appendChild($rootElement);
    }
}
