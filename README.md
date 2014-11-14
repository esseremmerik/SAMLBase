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

    include_once('./vendor/autoload.php');

    $cert = new Wizkunde\SAML2PHP\Configuration\Certificate('testcertificaat');

    /**
     * Auto resolving the metadata
     */
    $resolveService = new Wizkunde\SAML2PHP\Metadata\ResolveService(new GuzzleHttp\Client());
    $metadata = $resolveService->resolve(new \Wizkunde\SAML2PHP\Metadata\IDPMetadata(), 'http://idp.wizkunde.nl/simplesaml/saml2/idp/metadata.php');

    /**
     * To be loaded via configuration
     */
    $configuration = new Wizkunde\SAML2PHP\Configuration(array(
            'NameID'                    => 'testNameId',
            'Issuer'                    => 'http://saml.dev.wizkunde.nl/',
            'MetadataExpirationTime'    => 604800,
            'SPReturnUrl'               => 'http://return.wizkunde.nl/',
            'SigningCertificate'        => $cert,
            'EncryptionCertificate'     => $cert,
            'ForceAuthn'                => 'true',
            'IsPassive'                 => 'false',
            'UniqueID'                  => new Wizkunde\SAML2PHP\Configuration\UniqueID(),
            'Timestamp'                 => new Wizkunde\SAML2PHP\Configuration\Timestamp(),
            'NameIDFormat'              => $metadata['Metadata']['NameIDFormat']
        )
    );

    //$binding = new Wizkunde\SAML2PHP\Binding\Post();
    $binding = new Wizkunde\SAML2PHP\Binding\Redirect();
    $binding->setMetadata($metadata);
    $binding->setConfiguration($configuration);
    $redirectUrl = $binding->request();

## License information
This code is released under the GPL v3 license
Info about the license can be found here:  http://www.gnu.org/copyleft/gpl.html
