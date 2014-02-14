<?php

namespace Wizkunde\SAML2PHP\Configuration;

use Wizkunde\SAML2PHP\Configuration\Certificate;

class CertificateTest extends \PHPUnit_Framework_TestCase
{
    protected $certificate = null;

    public function setUp()
    {
        $this->certificate = new Certificate('testcert');
    }

    public function testIfCertificateDataIsSetOnConstruct()
    {
        $this->assertEquals($this->certificate->getCertificate(), 'testcert');
    }

    public function testIfCertificateDataCanBeOverwritten()
    {
        $this->certificate->setCertificate('certdata');
        $this->assertEquals($this->certificate->getCertificate(), 'certdata');
    }


}