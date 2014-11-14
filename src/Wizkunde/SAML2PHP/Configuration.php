<?php

namespace Wizkunde\SAML2PHP;

use Wizkunde\SAML2PHP\Configuration\Certificate;
use Wizkunde\SAML2PHP\Configuration\Timestamp;
use Wizkunde\SAML2PHP\Configuration\UniqueID;

class Configuration implements ConfigurationInterface
{
    const NAMEID_EMAIL_ADDRESS                 = 'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress';
    const NAMEID_X509_SUBJECT_NAME             = 'urn:oasis:names:tc:SAML:1.1:nameid-format:X509SubjectName';
    const NAMEID_WINDOWS_DOMAIN_QUALIFIED_NAME = 'urn:oasis:names:tc:SAML:1.1:nameid-format:WindowsDomainQualifiedName';
    const NAMEID_KERBEROS   = 'urn:oasis:names:tc:SAML:2.0:nameid-format:kerberos';
    const NAMEID_ENTITY     = 'urn:oasis:names:tc:SAML:2.0:nameid-format:entity';
    const NAMEID_TRANSIENT  = 'urn:oasis:names:tc:SAML:2.0:nameid-format:transient';
    const NAMEID_PERSISTENT = 'urn:oasis:names:tc:SAML:2.0:nameid-format:persistent';

    /**
     * @var array Basic configuration
     */
    protected $configuration = array(
        'NameID'                    => '',
        'Issuer'                    => '',
        'MetadataExpirationTime'    => 604800,
        'SPReturnUrl'               => '',
        'SigningCertificate'        => '',
        'EncryptionCertificate'     => '',
        'ComparisonLevel'           => 'exact',
        'ForceAuthn'                => 'false',
        'IsPassive'                 => 'false',
        'UniqueID'                  => '',
        'Timestamp'                 => '',
        'ProtocolBinding'           => '',
        'NameIDFormat'              => ''
    );

    /**
     * Set the configuration for the SAML Connection
     *
     * @param array $_configuration
     */
    public function __construct($configuration = array())
    {
        $this->setConfiguration($configuration);
    }

    public function get($configKey) {
        if(isset($this->configuration[$configKey])) {
            return $this->configuration[$configKey];
        }

        throw new \Exception('Call to unexistent configuration key: ' . $configKey);
    }

    /**
     * Setting a configuration value
     *
     * @param $configKey
     * @param $configValue
     */
    public function set($configKey, $configValue)
    {
        $this->configuration[$configKey] = $configValue;
    }

    /**
     * Get the Configuration data
     *
     * @return mixed array with configuraion data
     */
    public function getConfiguration()
    {
        return $this->configuration;
    }

    /**
     * @param mixed $configurationData configuration data
     */
    public function setConfiguration(array $configurationData)
    {
        if (count($configurationData) > 0) {
            foreach ($configurationData as $configurationKey => $value) {
                $this->configuration[$configurationKey] = $value;
            }
        }
    }
}
