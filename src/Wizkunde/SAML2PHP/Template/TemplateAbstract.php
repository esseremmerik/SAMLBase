<?php

namespace Wizkunde\SAML2PHP\Template;

use Wizkunde\SAML2PHP\Configuration;
use Wizkunde\SAML2PHP\ConfigurationTrait;
use Wizkunde\SAML2PHP\Configuration\Timestamp;
use Wizkunde\SAML2PHP\Configuration\UniqueID;

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

    public function __construct($type = 'AuthnRequest')
    {
    }

    public function getDocument()
    {
        return $this->document;
    }

    public function __toString()
    {
        $request = $this->document->saveXml();

        $deflatedRequest = gzdeflate($request);
        $base64Request = base64_encode($deflatedRequest);
        $encodedRequest = urlencode($base64Request);

        return $encodedRequest;
    }
}
