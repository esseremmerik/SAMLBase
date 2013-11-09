<?php

namespace Wizkunde\OpenSAML;

use Wizkunde\OpenSAML\Configuration\Certificate;

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
        'IDPMetadataUrl'            => '',
        'MetadataExpirationTime'    => 604800,
        'SPReturnUrl'               => '',
        'SigningCertificate'        => '',
        'EncryptionCertificate'     => '',
        'ComparisonLevel'           => 'exact'
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

    /**
     * Set the field that is used as NameId
     *
     * example: urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress
     *
     * @param string $nameId
     */
    public function setNameIdFormat($nameIdField = self::NAMEID_EMAIL_ADDRESS)
    {
        $this->configuration['NameID'] = $nameIdField;
    }

    /**
     * Get the field that is used as NameId
     *
     * @return string
     */
    public function getNameIdFormat()
    {
        return $this->configuration['NameID'];
    }

    /**
     * Get the comparison level
     *
     * @return string
     */
    public function getComparisonLevel()
    {
        return $this->configuration['ComparisonLevel'];
    }

    /**
     * Set the comparison level
     *
     * @return string name of the SP
     */
    public function setComparisonLevel($level = 'exact')
    {
        $this->configuration['ComparisonLevel'] = $level;
    }

    /**
     * Get the issuer
     *
     * @return string
     */
    public function getIssuer()
    {
        return $this->configuration['Issuer'];
    }

    /**
     * Set the name of the SP
     *
     * @return string name of the SP
     */
    public function setIssuer($issuer = '')
    {
        $this->configuration['Issuer'] = $issuer;
    }

    /**
     * Set the IDP Metadata URL
     *
     * @param string $idpMetadataUrl
     */
    public function setIdpMetadataUrl($idpMetadataUrl)
    {
        $this->configuration['IDPMetadataUrl'] = $idpMetadataUrl;
    }

    /**
     * Get the IDP Metadata URL
     * @return string
     */
    public function getIdpMetadataUrl()
    {
        return $this->configuration['IDPMetadataUrl'];
    }

    /**
     * Set the local Metadata expire time
     *
     * @param string $idpMetadataUrl
     */
    public function setMetadataExpirationTime($metadataExpireTime = 604800)
    {
        if(is_integer($metadataExpireTime)) {
            $this->configuration['MetadataExpirationTime'] = $metadataExpireTime;
        }
    }

    /**
     * Get the local Metadata expire time
     *
     * @return integer
     */
    public function getMetadataExpirationTime()
    {
        return $this->configuration['MetadataExpirationTime'];
    }


    /**
     * Set the return URL to return to in the SP
     * @param string $spReturnUrl
     */
    public function setSpReturnUrl($spReturnUrl = '')
    {
        $this->configuration['SPReturnUrl'] = $spReturnUrl;
    }

    /**
     * Get the SP return URL
     *
     * @return string
     */
    public function getSpReturnUrl()
    {
        return $this->configuration['SPReturnUrl'];
    }

    /**
     * @param object Wizkunde\OpenSAML\Configuration\Certificate
     */
    public function setIdpSigningCertificate(Certificate $certificate)
    {
        $this->configuration['SigningCertificate'] = $certificate;
    }

    /**
     * @return object Wizkunde\OpenSAML\Configuration\Certificate
     */
    public function getIdpSigningCertificate()
    {
        return $this->configuration['SigningCertificate'];
    }

    /**
     * @param object Wizkunde\OpenSAML\Configuration\Certificate
     */
    public function setIdpEncryptionCertificate(Certificate $certificate)
    {
        $this->configuration['EncryptionCertificate'] = $certificate;
    }

    /**
     * @return object Wizkunde\OpenSAML\Configuration\Certificate
     */
    public function getIdpEncryptionCertificate()
    {
        return $this->configuration['EncryptionCertificate'];
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
        if(count($configurationData) > 0) {
            foreach($configurationData as $configurationKey => $value)
            {
                if(array_key_exists($configurationKey, $this->configuration)) {
                    $this->configuration[$configurationKey] = $value;
                }
            }
        }
    }
}