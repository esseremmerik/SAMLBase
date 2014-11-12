SAML2PHP
=======

##Introduction
Build SAML Connections in php object based.

##Status
There is still a LOT of work to do, but the initial AuthNRequest can now be setup.
Works completely with the DOM instead of templates that are unchangeable and static.

##Setup
    composer install

Thats all!

##Example index.php to test it

    require_once('bootstrap.php');

    $binding = new Wizkunde\SAML2PHP\Binding\Redirect();
    $cert = new Wizkunde\SAML2PHP\Configuration\Certificate('testcertificaat');

    $configuration = new Wizkunde\SAML2PHP\Configuration(array(
        'NameID'                => 'testNameId',
        'Issuer'                    => 'Magento',
        'IDPMetadataUrl'            => 'http://idp.wizkunde.nl/simplesaml/saml2/idp/metadata.php',
        'MetadataExpirationTime'    => 604800,
        'SPReturnUrl'               => 'http://return.wizkunde.nl/',
        'SigningCertificate'        => $cert,
        'EncryptionCertificate'     => $cert,
        'ForceAuthn'                => false,
        'IsPassive'                 => false,
        'UniqueID'                  => new Wizkunde\SAML2PHP\Configuration\UniqueID(),
        'Timestamp'                 => new Wizkunde\SAML2PHP\Configuration\Timestamp()
    ));

    $binding->setConfiguration($configuration);
    $redirectUrl = $binding->request();

## License information
This code is released under the GPL v3 license
Info about the license can be found here:  http://www.gnu.org/copyleft/gpl.html
