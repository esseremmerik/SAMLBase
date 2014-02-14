<?php

namespace Wizkunde\SAML2PHP\Configuration;

use Wizkunde\SAML2PHP\Configuration;

interface MetadataInterface
{
    /**
     * @param Configuration $configuration
     * @return mixed
     */
    public function construct(Configuration $configuration);

    /**
     * @return string with xml data
     */
    public function getMetadata();
}
