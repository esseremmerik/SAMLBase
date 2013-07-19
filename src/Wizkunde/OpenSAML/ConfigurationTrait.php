<?php

namespace Wizkunde\OpenSAML;

use Wizkunde\OpenSAML\Template\TeplateAbstract;
use Wizkunde\OpenSAML\Configuration as SAMLConfiguration;

trait ConfigurationTrait
{
    protected $configuration = null;

    public function setConfiguration(SAMLConfiguration $configuration)
    {
        $this->configuration = $configuration;
    }

    public function getConfiguration()
    {
        return $this->configuration;
    }
}