<?php

namespace Wizkunde\SAML2PHP\Template;

use Wizkunde\SAML2PHP\Configuration;

/**
 * Class TemplateInterface
 *
 * Interface thats used for all SAML templates
 *
 * @package Wizkunde\SAML2PHP\Template
 */
interface TemplateInterface
{
    public function __construct($type = 'AuthnRequest', Configuration $configuration);
}
