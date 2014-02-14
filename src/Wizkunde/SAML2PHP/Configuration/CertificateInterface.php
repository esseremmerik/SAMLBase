<?php

/**
 * Interface that provides the contract for the certificate objects
 */
namespace Wizkunde\SAML2PHP\Configuration;

interface CertificateInterface
{
    /**
     * @param $certificateData
     */
    public function __construct($certificateData = '');

    /**
     * @return string certificate data
     */
    public function getCertificate();

    /**
     * overwrite the certificate data
     */
    public function setCertificate($certificateData = '');

    /**
     * validate certificate data
     */
    public function validateCertificate();

    /**
     * load the certificate data from a set file
     */
    public static function loadFromFile($directory, $filename);
}
