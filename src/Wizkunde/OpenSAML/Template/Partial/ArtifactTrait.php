<?php

namespace Wizkunde\OpenSAML\Template\Partial;

use Wizkunde\OpenSAML\Template\TeplateAbstract;

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
