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
        7. Event listeners register
            7.1 dont want to write the whole listener system ourselves, what can we use thats predefined
            7.2 What does symfony use for listener service?
            7.3 How can we listen to events without having to add event listener code lines to the code?

##Example index.php to test it

    include_once('./vendor/autoload.php');
    
    $certData = array(
        'passphrase' => 'test1234',
        'certificate' => '-----BEGIN CERTIFICATE-----
    MIICjTCCAfYCCQDsoZfp4pCvHDANBgkqhkiG9w0BAQUFADCBijELMAkGA1UEBhMC
    TkwxEzARBgNVBAgMClNvbWUtU3RhdGUxEjAQBgNVBAcMCVJvdHRlcmRhbTEWMBQG
    A1UECgwNV2l6a3VuZGUgQi5WLjEaMBgGA1UEAwwRUm9uIHZhbiBkZXIgTW9sZW4x
    HjAcBgkqhkiG9w0BCQEWD3JvbkB3aXprdW5kZS5ubDAeFw0xNDExMTUyMzE1MzZa
    Fw0xNzA4MTIyMzE1MzZaMIGKMQswCQYDVQQGEwJOTDETMBEGA1UECAwKU29tZS1T
    dGF0ZTESMBAGA1UEBwwJUm90dGVyZGFtMRYwFAYDVQQKDA1XaXprdW5kZSBCLlYu
    MRowGAYDVQQDDBFSb24gdmFuIGRlciBNb2xlbjEeMBwGCSqGSIb3DQEJARYPcm9u
    QHdpemt1bmRlLm5sMIGfMA0GCSqGSIb3DQEBAQUAA4GNADCBiQKBgQDrz1PnuZ3a
    96fTnzo6tZRmKs202zM9NcJIL/34Lzxal9KTSVBoI7ZRhIcOlODQikIVfvqRcmar
    kys/ZqljsRY70zyZg5+l7aSev0zt3mHJUianBJLl1yQ8TCbxAsaZO0WBvOA8Jtyv
    zM1CUOK1iDy/RTQgWAZILiSqOU1Qrq2TbQIDAQABMA0GCSqGSIb3DQEBBQUAA4GB
    ANHdOcbwuUbyfVikF7Hy3XR/i/SJ/Vq4xlWUWDemEcxPG1NbzcNiBUiOgFAGAmDa
    8mRZ6sm5V3u0qo0C6d5UoAN6t6LUR9Xu3iRBQWbGT6xbf3rgRzUfCO99tkPlQ3VP
    MamTEzqNLSPOpjqQjm6jyC/KmirRR8+UVpcz2C3GLX7/
    -----END CERTIFICATE-----',
        'privatekey' => '-----BEGIN RSA PRIVATE KEY-----
    MIICXQIBAAKBgQDrz1PnuZ3a96fTnzo6tZRmKs202zM9NcJIL/34Lzxal9KTSVBo
    I7ZRhIcOlODQikIVfvqRcmarkys/ZqljsRY70zyZg5+l7aSev0zt3mHJUianBJLl
    1yQ8TCbxAsaZO0WBvOA8JtyvzM1CUOK1iDy/RTQgWAZILiSqOU1Qrq2TbQIDAQAB
    AoGAMTupRgFADv6UAKAG9UkCAc7AAhmd+hKmTJIQkWezTyrRoUS2T/fc0eo8lHPK
    +F9Vas2HHSTogLwKVINnrFPF0zMvI5NRAzoS94/D8KHT5hJz2iHW8TNwqrc08Zed
    5AVBeN4g8qkot2DfeKLLCkmiVTNHCexgfskUvPi+LvfEsvUCQQD3EQS0ll0zlHqo
    YTAi/tC/wDCQReAbgO8a3bucFtp8fFzMJ2NGtaiUYcz/88Yj6dAlGtfOoTcrN8I4
    Zpf5RIkbAkEA9FYctHU+3YhHz4kKuayTT3DfdPkXbMMCzng10imkri5qamR0B7wA
    LLXkq1MCiaMzRamkEuHHqPYJEpju93XmFwJBANTWA1Cyi92oVjYBa19qVlgpb2yJ
    1XK8Er75LupbQaKl26c/cyVxzqTsz5Xa4eEERfwA8NIfTZBce2Ls9pSUtusCQQDI
    xp4N165R4fOIYUcz7dCa3dhxSWJrWA/NU9B+IwQUsUV2qZcC6ASIuOrvsWWLblTq
    cIzHi0pC1/H6mzr6k6H/AkBSj6gKNGK0zcH/OD5gJ6HJ5jXcFsCrcxp9tt4Kf7cv
    F1PdL+qxRCJjmEHc8B6mhAnX0VFGS7cSUBktYa2ftesv
    -----END RSA PRIVATE KEY-----'
    );
    
    /**
     * Load a private and public key into the xmlseclib format (XMLSecurityKey)
     */
    $cert = new \Wizkunde\SAML2PHP\Certificate\Certificate($certData['privatekey'], $certData['certificate'], $certData['passphrase']);
    
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
