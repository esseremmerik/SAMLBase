<?php

if(!isset($_POST['SAMLResponse']) && !isset($_GET['SAMLResponse'])) {
    header('Location: attributes.php');
}

include_once('../vendor/autoload.php');

$certData = array();
$certData['passphrase'] = 'test1234';
$certData['certificate'] = file_get_contents('./cert/example.crt');
$certData['privatekey'] = file_get_contents('./cert/example.pem');

$container = new Symfony\Component\DependencyInjection\ContainerBuilder();
$container->setParameter('NameID', 'testNameId');
$container->setParameter('Issuer', 'http://saml.dev.wizkunde.nl/');
$container->setParameter('MetadataExpirationTime', 604800);
$container->setParameter('SPReturnUrl', 'http://return.wizkunde.nl/');
$container->setParameter('ForceAuthn', 'false');
$container->setParameter('IsPassive', 'false');
$container->setParameter('NameIDFormat', 'testNameId');
$container->setParameter('ComparisonLevel', 'exact');

$container->register('twig_loader', 'Twig_Loader_Filesystem');
$container->get('twig_loader')->addPath('../src/Wizkunde/SAMLBase/Template/Twig', 'SAMLBase');
$container->register('twig', 'Twig_Environment')->addArgument(new Symfony\Component\DependencyInjection\Reference('twig_loader'));

$container->register('SigningCertificate', 'Wizkunde\SAMLBase\Certificate')
    ->addArgument($certData['privatekey'])
    ->addArgument($certData['certificate'])
    ->addArgument($certData['passphrase']);

$container->register('EncryptionCertificate', 'Wizkunde\SAMLBase\Certificate')
    ->addArgument($certData['privatekey'])
    ->addArgument($certData['certificate'])
    ->addArgument($certData['passphrase']);

$container->register('encryption', 'Wizkunde\SAMLBase\Security\Encryption')
    ->addMethodCall('setCertificate',array(new Symfony\Component\DependencyInjection\Reference('EncryptionCertificate')));

$container->register('signature', 'Wizkunde\SAMLBase\Security\Signature')
    ->addMethodCall('setCertificate',array(new Symfony\Component\DependencyInjection\Reference('SigningCertificate')));

$container->register('unique_id_generator', 'Wizkunde\SAMLBase\Configuration\UniqueID');
$container->register('timestamp_generator', 'Wizkunde\SAMLBase\Configuration\Timestamp');
/**
 * Setup the Metadata resolve service
 */
$container->register('guzzle_http', 'GuzzleHttp\Client');
$container->register('resolver', 'Wizkunde\SAMLBase\Metadata\ResolveService')
    ->addArgument(new Symfony\Component\DependencyInjection\Reference('guzzle_http'));

/**
 * Resolve the metadata
 */
$metadata = $container->get('resolver')->resolve(new \Wizkunde\SAMLBase\Metadata\IDPMetadata(), 'http://idp.wizkunde.nl/simplesaml/saml2/idp/metadata.php');


$container->register('response', 'Wizkunde\SAMLBase\Response\AuthnResponse')
    ->addMethodCall('setContainer', array($container));

$SAMLResponse = (isset($_POST['SAMLResponse'])) ?  $_POST['SAMLResponse'] : $_GET['SAMLResponse'];
$responseData = $container->get('response')->decode($SAMLResponse);

$attributes = new \Wizkunde\SAMLBase\Claim\Attributes();

var_dump($attributes->getAttributes($responseData));