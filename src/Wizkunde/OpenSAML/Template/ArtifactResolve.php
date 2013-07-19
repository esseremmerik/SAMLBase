<?php

namespace Wizkunde\OpenSAML\Template;

use Wizkunde\OpenSAML\Template\TeplateAbstract;
use Wizkunde\OpenSAML\Configuration\UniqueID;
use Wizkunde\OpenSAML\Configuration\Timestamp;

/**
 * Class Request
 *
 * Template for the ArtifactResolution
 *
 * @package Wizkunde\OpenSAML\Template
 */
class ArtifactResolve extends TemplateAbstract
{
    public function __toString()
    {
        // @todo set artifact

        $id = new UniqueID();
        $timestamp = new Timestamp();
        $artifact = '';

        $template = <<<ARTIFACTRESOLVE
<samlp:ArtifactResolve
    xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"
    xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"
    ID="{$id}"
    Version="2.0"
    IssueInstant="{$timestamp}">
    <saml:Issuer>https://idp.example.org/SAML2</saml:Issuer>
    <!-- an ArtifactResolve message SHOULD be signed -->
    <ds:Signature
      xmlns:ds="http://www.w3.org/2000/09/xmldsig#">...</ds:Signature>
    <samlp:Artifact>{$artifact}</samlp:Artifact>
  </samlp:ArtifactResolve>
ARTIFACTRESOLVE;

       return $template;
    }
}