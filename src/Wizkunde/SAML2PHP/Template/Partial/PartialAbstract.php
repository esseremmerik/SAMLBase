<?php

namespace Wizkunde\SAML2PHP\Template\Partial;

use Wizkunde\SAML2PHP\Configuration;
use Wizkunde\SAML2PHP\ConfigurationTrait;

/**
 * Class TemplateAbstract
 *
 * Abstract class that is used for creating templates
 *
 * @package Wizkunde\SAML2PHP\Template
 */
abstract class PartialAbstract
{
    use ConfigurationTrait;

    protected $uniqueId;
    protected $timestamp;
    protected $node = null;

    public function __construct(\DOMDocument $document, Configuration $configuration)
    {

    }

    public function getNode()
    {
        return $this->node;
    }
}
