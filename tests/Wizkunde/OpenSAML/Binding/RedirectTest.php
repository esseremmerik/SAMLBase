<?php

namespace Wizkunde\OpenSAML\Binding;

use Wizkunde\OpenSAML\Binding\Redirect;
use Wizkunde\OpenSAML\Configuration\Certificate;
use Wizkunde\OpenSAML\Configuration;

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
                'EncryptionCertificate'     => $cert
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
