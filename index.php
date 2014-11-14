<?php

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
