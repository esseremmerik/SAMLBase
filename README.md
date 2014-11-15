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

## Current Status (Last updated 14-11-2014)

    There is more to do than what i've listed here, but this is to get the framework started

    DONE
        1. Resolve metadata from an IDP into a PHP array that we can work with
        2. Do a AuthNRequest via Redirect Binding
        3. Do a AuthNRequest via POST Binding
        4. Handle the AuthNResponse
        5. Pass thru returning attributes and claims

    TODO
        1. Support SOAP and Artifact binding
        2. Handle a Single Logout Request
        3. Refactor the template engine so that its not instantiating partials all the time
            3.1 Twig as an option?
                3.1.1 Disadvantage: Add a template engine that might not be used by the systems its used in
                3.1.2 Advantage: Easy templating and assigning of variables
            3.2 Automatic iterator to add partials via configuration in the template classes?
                3.2.1 Instead of adding all the partials with new instantiation, iterate over some setting information and automatically instantiate the right classes
                3.2.2 Classes might best be mapped as some form of service / helper, instead of calling them directly
                3.2.3 In this way you can remove them, mock them, change them around. But how?
            3.3 Main goal should be that now there is to much tight coupling between templates, it needs to go
        4. Give the library a better name, SAML2PHP is lame.
        5. Support persistency of the tokens
        6. Unit Tests

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
