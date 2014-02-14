<?php

namespace Wizkunde\SAML2PHP\Template\Partial;

use Wizkunde\SAML2PHP\Template\TeplateAbstract;

trait ArtifactTrait
{
    public function getArtifactTemplate($artifact)
    {
        $template = <<<ARTIFACT
            <samlp:Artifact>{$artifact}</samlp:Artifact>
ARTIFACT;

        return $template;
    }
}
