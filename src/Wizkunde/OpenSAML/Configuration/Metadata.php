<?php

namespace Wizkunde\OpenSAML\Configuration;

use Wizkunde\OpenSAML\Configuration;
use Wizkunde\OpenSAML\Template\Metadata as MetadataTemplate;
use Wizkunde\OpenSAML\ConfigurationTrait;

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
        $metadataTemplate = new MetadataTemplate();
        $metadataTemplate->setConfiguration($this->getConfiguration());

        return (string)$metadataTemplate;
    }
}
