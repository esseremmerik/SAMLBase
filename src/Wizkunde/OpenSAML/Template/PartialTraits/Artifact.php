<?php

namespace Wizkunde\OpenSAML\Template\PartialTraits;

use Wizkunde\OpenSAML\Template\TeplateAbstract;

trait Artifact
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