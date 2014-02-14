<?php

namespace Wizkunde\SAML2PHP;

use Wizkunde\SAML2PHP\Template\TeplateAbstract;
use Wizkunde\SAML2PHP\Configuration as SAMLConfiguration;

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
