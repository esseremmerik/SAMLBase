<?php

namespace Wizkunde\OpenSAML\Template\Partial;

use Wizkunde\OpenSAML\Template\TeplateAbstract;

class Signature extends TemplateAbstract
{
    public function __toString()
    {
        $template = <<<SIGNATURE
    <ds:Signature
      xmlns:ds="http://www.w3.org/2000/09/xmldsig#">...</ds:Signature>
SIGNATURE;

        return $template;
    }
}