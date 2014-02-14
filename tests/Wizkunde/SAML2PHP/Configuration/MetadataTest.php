<?php

namespace Wizkunde\SAML2PHP\Configuration;

use Wizkunde\SAML2PHP\Configuration\Metadata;
use Wizkunde\SAML2PHP\Configuration;

class MetadataTest extends \PHPUnit_Framework_TestCase
{
    protected $metadata = null;
    protected $configuration = null;

    public function setUp()
    {
        $cert = new Certificate('testcertificaat');

        $this->configuration = new Configuration(array(
                'NameID'                => 'testNameId',
                'Issuer'                    => 'testIssuer',
                'IDPMetadataUrl'            => 'http://idp.wizkunde.nl/simplesaml/saml2/idp/metadata.php',
                'MetadataExpirationTime'    => 604800,
                'SPReturnUrl'               => 'http://return.wizkunde.nl/',
                'SigningCertificate'        => $cert,
                'EncryptionCertificate'     => $cert
            )
        );

        $this->metadata = new Metadata($this->configuration);
        $this->metadata->setConfiguration($this->configuration);
    }

    public function testIfMetadataIsProperlyReturned()
    {
        $this->assertStringStartsWith('<?xml version="1.0"?>', $this->metadata->getMetadata());
    }
}