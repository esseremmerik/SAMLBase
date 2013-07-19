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
     * Setup the template with configuration
     *
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration);

    /**
     * Automatically return the template as a string
     *
     * @return string
     */
    public function __toString();
}