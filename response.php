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
        'SigningAlgorithm'          => $metadata['Signature']['SigningMethod'],
        'EncryptionCertificate'     => $cert,
        'EncryptionAlgorithm'       => $metadata['Encryption']['DigestMethod'],
        'ForceAuthn'                => 'true',
        'IsPassive'                 => 'false',
        'UniqueID'                  => new Wizkunde\SAML2PHP\Configuration\UniqueID(),
        'Timestamp'                 => new Wizkunde\SAML2PHP\Configuration\Timestamp(),
        'NameIDFormat'              => $metadata['Metadata']['NameIDFormat'],
    )
);

$response = new Wizkunde\SAML2PHP\Response\AuthnResponse($configuration);
$responseData = $response->decode($_POST['SAMLResponse']);

$attributes = new \Wizkunde\SAML2PHP\Claim\Attributes();

var_dump($attributes->getAttributes($responseData));