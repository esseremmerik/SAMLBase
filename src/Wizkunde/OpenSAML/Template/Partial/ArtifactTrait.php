<?php

namespace Wizkunde\OpenSAML\Template\Partial;

use Wizkunde\OpenSAML\Template\TeplateAbstract;

trait ArtifactTrait
{
    public function getArtifactTemplate()
    {
        // @todo actually set artifact
        $artifact = '';

        $template = <<<ARTIFACT
            <samlp:Artifact>{$artifact}</samlp:Artifact>
ARTIFACT;

        return $template;
    }
}