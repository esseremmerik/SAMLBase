<?php

include_once('./vendor/autoload.php');

function SAML2PHP_Autoload($classname) {
    $file = preg_replace('/\\\/', DIRECTORY_SEPARATOR, $classname) . '.php';
    echo $file . '<br />';
    include ($file);
}

spl_autoload_register('SAML2PHP_Autoload');

$binding = new Wizkunde\SAML2PHP\Binding\Redirect();

$cert = new Wizkunde\SAML2PHP\Configuration\Certificate('testcertificaat');

$configuration = new Wizkunde\SAML2PHP\Configuration(array(
        'NameID'                => 'testNameId',
        'Issuer'                    => '',
        'IDPMetadataUrl'            => 'http://idp.wizkunde.nl/simplesaml/saml2/idp/metadata.php',
        'MetadataExpirationTime'    => 604800,
        'SPReturnUrl'               => 'http://return.wizkunde.nl/',
        'SigningCertificate'        => $cert,
        'EncryptionCertificate'     => $cert,
        'UniqueID'                  => new Wizkunde\SAML2PHP\Configuration\UniqueID(),
        'Timestamp'                 => new Wizkunde\SAML2PHP\Configuration\Timestamp()
    )
);

$binding->setConfiguration($configuration);

$redirectUrl = $this->binding->request();

var_dump($redirectUrl);die;
