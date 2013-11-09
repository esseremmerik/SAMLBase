<?php

namespace Wizkunde\OpenSAML\Template;
use Wizkunde\OpenSAML\Configuration;

/**
 * Class TemplateInterface
 *
 * Interface thats used for all SAML templates
 *
 * @package Wizkunde\OpenSAML\Template
 */
interface TemplateInterface
{
    /**
     * Automatically return the template as a string
     *
     * @return string
     */
    public function __toString();
}
