<?php

include_once('./vendor/autoload.php');

function SAML2PHP_Autoload($classname) {
    $file = preg_replace('/\\\/', DIRECTORY_SEPARATOR, $classname) . '.php';
    echo $file . '<br />';
    include ($file);
}

spl_autoload_register('SAML2PHP_Autoload');

//$binding = new Wizkunde\SAML2PHP\Binding\Redirect();
$binding = new Wizkunde\SAML2PHP\Binding\Post();
$cert = new Wizkunde\SAML2PHP\Configuration\Certificate('testcertificaat');

$configuration = new Wizkunde\SAML2PHP\Configuration(array(
        'NameID'                => 'testNameId',
        'Issuer'                    => 'http://saml.dev.wizkunde.nl/',
        'IDPMetadataUrl'            => 'http://idp.wizkunde.nl/simplesaml/saml2/idp/metadata.php',
        'MetadataExpirationTime'    => 604800,
        'SPReturnUrl'               => 'http://return.wizkunde.nl/',
        'SigningCertificate'        => $cert,
        'EncryptionCertificate'     => $cert,
        'ForceAuthn'                => true,
        'IsPassive'                 => false,
        'UniqueID'                  => new Wizkunde\SAML2PHP\Configuration\UniqueID(),
        'Timestamp'                 => new Wizkunde\SAML2PHP\Configuration\Timestamp()
    )
);

$binding->setClient(new Guzzle\Http\Client());
$binding->setConfiguration($configuration);
$redirectUrl = $binding->request();
