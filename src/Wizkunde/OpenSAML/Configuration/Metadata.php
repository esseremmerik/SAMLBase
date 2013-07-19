<?php

namespace Wizkunde\OpenSAML\Configuration;

use Wizkunde\OpenSAML\Configuration;
use Wizkunde\OpenSAML\Template\Metadata as MetadataTemplate;

class Metadata implements MetadataInterface
{
    /**
     * @var Wizkunde\OpenSAML\Configuration
     */
    protected $configuration = null;

    /**
     * @param Configuration $configuration
     * @return mixed
     */
    public function construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @return string with xml data
     */
    public function getMetadata()
    {
        return new MetadataTemplate($this->configuration);
    }
}