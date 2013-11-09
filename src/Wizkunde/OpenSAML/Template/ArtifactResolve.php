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
    use \Wizkunde\OpenSAML\Template\Partial\ArtifactTrait;
    use \Wizkunde\OpenSAML\Template\Partial\IssuerTrait;
    use \Wizkunde\OpenSAML\Template\Partial\SignatureTrait;

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
