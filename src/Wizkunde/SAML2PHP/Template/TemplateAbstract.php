<?php

namespace Wizkunde\SAML2PHP\Template;

use Wizkunde\SAML2PHP\Configuration;
use Wizkunde\SAML2PHP\ConfigurationTrait;

/**
 * Class TemplateAbstract
 *
 * Abstract class that is used for creating templates
 *
 * @package Wizkunde\SAML2PHP\Template
 */
abstract class TemplateAbstract implements TemplateInterface
{
    use ConfigurationTrait;

    protected $uniqueId;
    protected $timestamp;

    /**
     * @var DOMDocument instance
     */
    protected $document = null;

    public function __construct($type = 'AuthnRequest', Configuration $configuration)
    {
        $this->setConfiguration($configuration);
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function __toString()
    {
        return $this->document->saveXml();
    }
}
