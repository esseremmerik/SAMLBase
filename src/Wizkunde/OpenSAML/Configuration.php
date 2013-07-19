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
    public $_configuration = array(
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
    public function __construct($_configuration = array())
    {
        $this->setConfiguration($_configuration);
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
        $this->_configuration['NameIDFormat'] = $nameIdField;
    }

    /**
     * Get the field that is used as NameId
     *
     * @return string
     */
    public function getNameIdFormat()
    {
        return $this->_configuration['NameID'];
    }

    /**
     * Get the comparison level
     *
     * @return string
     */
    public function getComparisonLevel()
    {
        return $this->_configuration['ComparisonLevel'];
    }

    /**
     * Set the comparison level
     *
     * @return string name of the SP
     */
    public function setComparisonLevel($level = 'exact')
    {
        $this->_configuration['ComparisonLevel'] = $level;
    }

    /**
     * Get the issuer
     *
     * @return string
     */
    public function getIssuer()
    {
        return $this->_configuration['Issuer'];
    }

    /**
     * Set the name of the SP
     *
     * @return string name of the SP
     */
    public function setIssuer($issuer = '')
    {
        $this->_configuration['Issuer'] = $issuer;
    }

    /**
     * Set the IDP Metadata URL
     *
     * @param string $idpMetadataUrl
     */
    public function setIdpMetadataUrl($idpMetadataUrl)
    {
        $this->_configuration['IDPMetadataUrl'] = $idpMetadataUrl;
    }

    /**
     * Get the IDP Metadata URL
     * @return string
     */
    public function getIdpMetadataUrl()
    {
        return $this->_configuration['IDPMetadataUrl'];
    }

    /**
     * Set the local Metadata expire time
     *
     * @param string $idpMetadataUrl
     */
    public function setMetadataExpirationTime($metadataExpireTime = 604800)
    {
        if(is_integer($metadataExpireTime)) {
            $this->_configuration['MetadataExpirationTime'] = $metadataExpireTime;
        }
    }

    /**
     * Get the local Metadata expire time
     *
     * @return integer
     */
    public function getMetadataExpirationTime()
    {
        return $this->_configuration['MetadataExpirationTime'];
    }


    /**
     * Set the return URL to return to in the SP
     * @param string $spReturnUrl
     */
    public function setSpReturnUrl($spReturnUrl = '')
    {
        $this->_configuration['SPReturnUrl'] = $spReturnUrl;
    }

    /**
     * Get the SP return URL
     *
     * @return string
     */
    public function getSpReturnUrl()
    {
        return $this->_configuration['SPReturnUrl'];
    }

    /**
     * @param object Wizkunde\OpenSAML\Configuration\Certificate
     */
    public function setIdpSigningCertificate(Certificate $certificate)
    {
        $this->_configuration['SigningCertificate'] = $certificate;
    }

    /**
     * @return object Wizkunde\OpenSAML\Configuration\Certificate
     */
    public function getIdpSigningCertificate()
    {
        return $this->_configuration['SigningCertificate'];
    }

    /**
     * @param object Wizkunde\OpenSAML\Configuration\Certificate
     */
    public function setIdpEncryptionCertificate(Certificate $certificate)
    {
        $this->_configuration['EncryptionCertificate'] = $certificate;
    }

    /**
     * @return object Wizkunde\OpenSAML\Configuration\Certificate
     */
    public function getIdpEncryptionCertificate()
    {
        return $this->_configuration['EncryptionCertificate'];
    }

    /**
     * Get the Configuration data
     *
     * @return mixed array with configuraion data
     */
    public function getConfiguration()
    {
        return $this->_configuration;
    }

    /**
     * @param mixed $configurationData configuration data
     */
    public function setConfiguration(array $configurationData)
    {
        if(count($configurationData) > 0) {
            foreach($configurationData as $configurationKey => $value)
            {
                if(array_key_exists($configurationData, $this->_configuration)) {
                    $this->_configuration[$configurationData] = $value;
                }
            }
        }
    }
}