<?php

namespace Wizkunde\OpenSAML\Template\Partial;

use Wizkunde\OpenSAML\Template\TeplateAbstract;

trait IssuerTrait
{
    public function getIssuerTemplate()
    {
        // @todo actually set issuer
        $issuer = '';

        $template = <<<ISSUER
                <saml:Issuer>{$issuer}</saml:Issuer>
ISSUER;

        return $template;
    }
}