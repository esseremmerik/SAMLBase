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
    /**
     * Template traits
     */
    use \Wizkunde\OpenSAML\Template\PartialTraits\Artifact;
    use \Wizkunde\OpenSAML\Template\PartialTraits\Issuer;
    use \Wizkunde\OpenSAML\Template\PartialTraits\Signature;

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
    {$this->getIssuerTemplate()}
    {$this->getSignatureTemplate()}
    {$this->getArtifactTemplate()}
  </samlp:ArtifactResolve>
ARTIFACTRESOLVE;

       return $template;
    }
}