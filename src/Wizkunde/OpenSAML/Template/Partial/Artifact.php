<?php

namespace Wizkunde\OpenSAML\Template\Partial;

use Wizkunde\OpenSAML\Template\TeplateAbstract;

class Artifact extends TemplateAbstract
{
    public function __toString()
    {
        // @todo actually set artifact
        $artifact = '';

        $template = <<<ARTIFACT
            <samlp:Artifact>{$artifact}</samlp:Artifact>
ARTIFACT;

        return $template;
    }
}