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
     * Set the field that is used as NameId
     *
     * example: urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress
     *
     * @param string $nameIdField
     */
    public function setNameIdFormat($nameIdField);

    /**
     * Get the field that is used as NameId
     *
     * @return string
     */
    public function getNameIdFormat();

    /**
     * Get the issuer
     *
     * @return string
     */
    public function getIssuer();

    /**
     * Set the name of the SP
     *
     * @return string name of the SP
     */
    public function setIssuer($issuer = '');

    /**
     * Set the IDP Metadata URL
     *
     * @param string $idpMetadataUrl
     */
    public function setIdpMetadataUrl($idpMetadataUrl);

    /**
     * Get the IDP Metadata URL
     * @return string
     */
    public function getIdpMetadataUrl();

    /**
     * Set the local Metadata expire time
     *
     * @param string $idpMetadataUrl
     */
    public function setMetadataExpirationTime($metadataExpireTime = 604800);

    /**
     * Get the local Metadata expire time
     *
     * @return integer
     */
    public function getMetadataExpirationTime();


    /**
     * Set the return URL to return to in the SP
     * @param string $spReturnUrl
     */
    public function setSpReturnUrl($spReturnUrl = '');

    /**
     * Get the SP return URL
     *
     * @return string
     */
    public function getSpReturnUrl();

    /**
     * @param object Wizkunde\SAML2PHP\Configuration\Certificate
     */
    public function setIdpSigningCertificate(Certificate $certificate);

    /**
     * @return object Wizkunde\SAML2PHP\Configuration\Certificate
     */
    public function getIdpSigningCertificate();

    /**
     * @param object Wizkunde\SAML2PHP\Configuration\Certificate
     */
    public function setIdpEncryptionCertificate(Certificate $certificate);

    /**
     * @return object Wizkunde\SAML2PHP\Configuration\Certificate
     */
    public function getIdpEncryptionCertificate();

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
