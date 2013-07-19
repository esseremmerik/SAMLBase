<?php

namespace Wizkunde\OpenSAML\Template\Partial;

use Wizkunde\OpenSAML\Template\TeplateAbstract;

class Issuer extends TemplateAbstract
{
    public function __toString()
    {
        // @todo actually set issuer
        $issuer = '';

        $template = <<<ISSUER
                <saml:Issuer>{$issuer}</saml:Issuer>
ISSUER;

        return $template;
    }
}