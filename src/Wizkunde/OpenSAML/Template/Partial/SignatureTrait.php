<?php

namespace Wizkunde\OpenSAML\Template\Partial;

use Wizkunde\OpenSAML\Template\TeplateAbstract;

trait SignatureTrait
{
    public function getSignatureTemplate()
    {
        $template = <<<SIGNATURE
    <ds:Signature
      xmlns:ds="http://www.w3.org/2000/09/xmldsig#">...</ds:Signature>
SIGNATURE;

        return $template;
    }
}