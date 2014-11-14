<?php

namespace Wizkunde\SAML2PHP;

use Wizkunde\SAML2PHP\Configuration\Certificate;

/**
 * Class ConfigurationInterface
 *
 * Interface that will provide the class contracts for the configuration itself
 *
 * @package Wizkunde\SAML2PHP
 */
interface ConfigurationInterface
{
    /**
     * Get a configuration value
     *
     * @param $configKey
     * @return mixed
     */
    public function get($configKey);

    /**
     * Get the Configuration data
     *
     * @return mixed array with configuraion data
     */
    public function getConfiguration();

    /**
     * @param mixed $configurationData configuration data
     */
    public function setConfiguration(array $configurationData);
}
