<?php

namespace Wizkunde\SAML2PHP\Template\Partial;

use Wizkunde\SAML2PHP\Template\TeplateAbstract;

trait IssuerTrait
{
    public function getIssuerTemplate($issuer)
    {
        $template = <<<ISSUER
                <saml:Issuer>{$issuer}</saml:Issuer>
ISSUER;

        return $template;
    }
}
