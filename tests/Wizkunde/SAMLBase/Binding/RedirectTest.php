<?php

namespace Wizkunde\SAMLBase\Binding;

use Wizkunde\SAMLBase\Binding\Redirect;
use Wizkunde\SAMLBase\Configuration\Certificate;
use Wizkunde\SAMLBase\Configuration;
use Wizkunde\SAMLBase\Configuration\Timestamp;
use Wizkunde\SAMLBase\Configuration\UniqueID;

class RedirectTest extends \PHPUnit_Framework_TestCase
{
    protected $binding = null;
    protected $configuration = null;

    public function setUp()
    {
        $this->binding = new Redirect();

        $cert = new Certificate('testcertificaat');

        $this->configuration = new Configuration(array(
                'NameID'                => 'testNameId',
                'Issuer'                    => '',
                'IDPMetadataUrl'            => 'http://idp.wizkunde.nl/simplesaml/saml2/idp/metadata.php',
                'MetadataExpirationTime'    => 604800,
                'SPReturnUrl'               => 'http://return.wizkunde.nl/',
                'SigningCertificate'        => $cert,
                'EncryptionCertificate'     => $cert,
                'UniqueID'                  => new UniqueID(),
                'Timestamp'                 => new Timestamp()
            )
        );

        $this->binding->setConfiguration($this->configuration);
    }

    public function testIfRequestBuildsProperRedirectURL()
    {
        $redirectUrl = $this->binding->request();

        // @todo: Hardcoded value to be replaced
        $this->assertStringStartsWith('http://idp.wizkunde.nl/simplesaml/saml2/idp/SSOService.php', $redirectUrl);
    }
}
