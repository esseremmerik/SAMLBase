<?php

namespace Wizkunde\SAML2PHP\Template\Partial;

use Wizkunde\SAML2PHP\Template\TeplateAbstract;

trait SignatureTrait
{
    public function getSignatureTemplate($signature)
    {
        $template = <<<SIGNATURE
    <ds:Signature
      xmlns:ds="http://www.w3.org/2000/09/xmldsig#">{$signature}</ds:Signature>
SIGNATURE;

        return $template;
    }
}
