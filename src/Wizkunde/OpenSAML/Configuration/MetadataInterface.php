<?php

namespace Wizkunde\OpenSAML\Configuration;

use Wizkunde\OpenSAML\Configuration;

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