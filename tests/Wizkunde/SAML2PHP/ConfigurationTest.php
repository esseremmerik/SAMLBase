<?php

namespace Wizkunde\SAMLBase;

use Wizkunde\SAMLBase\Configuration;
use Wizkunde\SAMLBase\Configuration\Certificate;

class ConfigurationTest extends \PHPUnit_Framework_TestCase
{
    protected $configuration = null;

    public function setUp()
    {
        $this->configuration = new Configuration();
    }

    public function testNameIdFormatIsSetProperly()
    {
        $this->configuration->setNameIdFormat('urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress');
        $this->assertEquals($this->configuration->getNameIdFormat(), 'urn:oasis:names:tc:SAML:1.1:nameid-format:emailAddress');
    }

    public function testComparisonLevelSetProperly()
    {
        $this->configuration->setComparisonLevel('exact');
        $this->assertEquals($this->configuration->getComparisonLevel() , 'exact');
    }

    public function testIssuerSetProperly()
    {
        $this->configuration->setIssuer('testIssuer');
        $this->assertEquals($this->configuration->getIssuer() , 'testIssuer');
    }

    public function testIdpMetadataUrlSetProperly()
    {
        $this->configuration->setIdpMetadataUrl('http://idp.wizkunde.nl/simplesaml/saml2/idp/metadata.php');
        $this->assertEquals($this->configuration->getIdpMetadataUrl() , 'http://idp.wizkunde.nl/simplesaml/saml2/idp/metadata.php');
    }

    public function testMetadataExpirationTimeSetProperly()
    {
        $this->configuration->setMetadataExpirationTime(1337);
        $this->assertEquals($this->configuration->getMetadataExpirationTime(), 1337);
    }

    public function testSPReturnUrlSetProperly()
    {
        $this->configuration->setSpReturnUrl('http://return.wizkunde.nl/');
        $this->assertEquals($this->configuration->getSpReturnUrl(), 'http://return.wizkunde.nl/');
    }

    public function testIdpSigningCertificateSetProperly()
    {
        $cert = new Certificate('testcertificaat');
        $this->configuration->setIdpSigningCertificate($cert);
        $this->assertInstanceOf('Wizkunde\SAMLBase\Configuration\Certificate', $this->configuration->getIdpSigningCertificate());
    }

    public function testIdpEncryptionCertificateSetProperly()
    {
        $cert = new Certificate('testcertificaat');
        $this->configuration->setIdpEncryptionCertificate($cert);
        $this->assertInstanceOf('Wizkunde\SAMLBase\Configuration\Certificate', $this->configuration->getIdpEncryptionCertificate());
    }

    public function testSetMassConfiguration()
    {
        $cert = new Certificate('testcertificaat');

        $this->configuration->setConfiguration(
            array(
                'SPReturnUrl'           => 'http://return.wizkunde.nl/',
                'SigningCertificate'    => $cert
            )
        );

        $this->assertInstanceOf('Wizkunde\SAMLBase\Configuration\Certificate', $this->configuration->getIdpSigningCertificate());
        $this->assertEquals($this->configuration->getSpReturnUrl(), 'http://return.wizkunde.nl/');
    }

    public function testGetConfiguration()
    {
        $this->assertTrue(is_array($this->configuration->getConfiguration()));
    }
}