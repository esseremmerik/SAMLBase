<?php

namespace Wizkunde\SAML2PHP\Template;

use Wizkunde\SAML2PHP\Template\TeplateAbstract;
use Wizkunde\SAML2PHP\Configuration\UniqueID;
use Wizkunde\SAML2PHP\Configuration\Timestamp;

/**
 * Class Request
 *
 * Template for the ArtifactResolution
 *
 * @package Wizkunde\SAML2PHP\Template
 */
class ArtifactResolve extends TemplateAbstract
{
    /**
     * Template traits
     */
    use \Wizkunde\SAML2PHP\Template\Partial\ArtifactTrait;
    use \Wizkunde\SAML2PHP\Template\Partial\IssuerTrait;
    use \Wizkunde\SAML2PHP\Template\Partial\SignatureTrait;

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
    {$this->getIssuerTemplate($this->getConfiguration()->getIssuer())}
    {$this->getSignatureTemplate($signature)}
    {$this->getArtifactTemplate($artifact)}
  </samlp:ArtifactResolve>
ARTIFACTRESOLVE;

        return $template;
    }
}
