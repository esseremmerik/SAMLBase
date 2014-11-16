<?php

namespace Wizkunde\SAML2PHP\Configuration;

use Wizkunde\SAML2PHP\Configuration;

interface MetadataInterface
{
    /**
     * @return string with xml data
     */
    public function getMetadata();
}
