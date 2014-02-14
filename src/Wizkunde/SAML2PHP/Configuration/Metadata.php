<?php

namespace Wizkunde\SAML2PHP\Configuration;

use Wizkunde\SAML2PHP\Configuration;
use Wizkunde\SAML2PHP\Configuration\UniqueID;
use Wizkunde\SAML2PHP\Configuration\Timestamp;
use Wizkunde\SAML2PHP\Template\Metadata as MetadataTemplate;
use Wizkunde\SAML2PHP\ConfigurationTrait;

class Metadata implements MetadataInterface
{
    use ConfigurationTrait;

    /**
     * @param Configuration $configuration
     * @return mixed
     */
    public function construct(Configuration $configuration)
    {
        $this->setConfiguration($configuration);
    }

    /**
     * @return string with xml data
     */
    public function getMetadata()
    {
        $metadataTemplate = new MetadataTemplate(new UniqueID(), new Timestamp());
        $metadataTemplate->setConfiguration($this->getConfiguration());

        return (string)$metadataTemplate;
    }
}
