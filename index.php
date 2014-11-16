<?php

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
