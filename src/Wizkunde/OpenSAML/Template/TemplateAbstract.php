<?php

namespace Wizkunde\OpenSAML\Template;

use Wizkunde\OpenSAML\Configuration;

/**
 * Class TemplateAbstract
 *
 * Abstract class that is used for creating templates
 *
 * @package Wizkunde\OpenSAML\Template
 */
abstract class TemplateAbstract implements TemplateInterface
{
    protected $configuration = null;

    public function __construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }
}