<?php

namespace Wizkunde\SAML2PHP\Template;

use Wizkunde\SAML2PHP\Template\Partial\Artifact;
use Wizkunde\SAML2PHP\Template\TeplateAbstract;
use Wizkunde\SAML2PHP\Configuration;

/**
 * Class Request
 *
 * Template for the ArtifactResolution
 *
 * @package Wizkunde\SAML2PHP\Template
 */
class ArtifactResolve extends Request
{
    public function __construct($type = 'ArtifactResolve', Configuration $configuration)
    {
        parent::__construct('ArtifactResolve', $configuration);

        $rootElement = $this->document->documentElement;

        // Add the issuer part
        $issuer = new Issuer($this->document, $this->getConfiguration());
        $rootElement->appendChild(
            $issuer->getNode()
        );

        // Add the NameIDPolicy
        $nameIdPolicy = new NameIDPolicy($this->document, $this->getConfiguration());
        $rootElement->appendChild(
            $nameIdPolicy->getNode()
        );

        $artifactNode = new Artifact($this->document, $this->getConfiguration());
        $rootElement->appendChild(
            $artifactNode->getNode()
        );
    }

    public function __toString()
    {
        // @todo set artifact

        $artifact = '';
        $signature = '';

        $template = <<<ARTIFACTRESOLVE
<samlp:ArtifactResolve
    xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"
    xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"
    ID="{$this->uniqueId}"
    Version="2.0"
    IssueInstant="{$this->timestamp}">
    {$this->getIssuerTemplate($this->getConfiguration()->get('Issuer'))}
    {$this->getSignatureTemplate($signature)}
    {$this->getArtifactTemplate($artifact)}
  </samlp:ArtifactResolve>
ARTIFACTRESOLVE;

        return $template;
    }
}
