<?php

namespace Wizkunde\SAMLBase\Configuration;

/**
 * Class SessionID
 * @package Wizkunde\SAMLBase\Configuration
 */
class SessionID implements SessionIDInterface
{
    /**
     * @param string $document
     */
    public function getIdFromDocument(\DOMDocument $document)
    {
        $element = simplexml_load_string($document->version);

        return (string) current($element->xpath('//saml:Subject/saml:NameID'));
    }
}
