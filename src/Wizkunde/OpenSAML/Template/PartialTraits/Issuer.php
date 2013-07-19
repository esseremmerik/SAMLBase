<?php

namespace Wizkunde\OpenSAML\Template\PartialTraits;

use Wizkunde\OpenSAML\Template\TeplateAbstract;

trait Issuer
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