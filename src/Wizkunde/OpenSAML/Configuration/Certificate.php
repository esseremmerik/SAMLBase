<?php

namespace Wizkunde\OpenSAML\Configuration;

use Wizkunde\OpenSAML\Configuration\CertificateInterface;

/**
 * Class Certificate
 *
 * Hold the certificate data for either signing or encryption
 * @package Wizkunde\OpenSAML\Configuration
 */
class Certificate implements CertificateInterface
{
    public $_certificate = '';

    /**
     * Setup the certificate
     *
     * @param string $certificateData
     */
    public function __construct($certificateData = '')
    {
        $this->setCertificate($certificateData);
    }

    /**
     * @return string
     */
    public function getCertificate()
    {
        return $this->_certificate;
    }

    /**
     * Set the certificate data
     *
     * @param string $certificateData
     */
    public function setCertificate($certificateData = '')
    {
        $this->_certificate = $certificateData;
    }

    /**
     * Validate the certificate data to see if its a valid certificate
     */
    public function validateCertificate()
    {
        //@todo validate the Certificate that we load/loaded
    }

    /**
     * @param $filedir
     * @param $filename
     */
    public static function loadFromFile($filedir, $filename)
    {
        //@todo enable certificate loading from files and return an instance of self
    }
}