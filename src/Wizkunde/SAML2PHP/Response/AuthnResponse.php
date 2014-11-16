<?php

namespace Wizkunde\SAML2PHP\Response;

use Wizkunde\SAML2PHP\Security\Encryption;
use Wizkunde\SAML2PHP\Security\Signature;

class AuthnResponse
{
    /**
     * Contains the dependency injection container
     *
     * @var null
     */
    protected $container = null;

    /**
     * Handle the response string that we receive
     *
     * @param $response
     */
    public function decode($response)
    {
        $responseData = base64_decode($response);

        $encryption = new Encryption();
        $decryptedDocument = $encryption->decrypt($responseData, $this->getContainer()->get('EncryptionCertificate'));

        $signature = new Signature();
        $signature->setCertificate($this->getContainer()->get('SigningCertificate'));
        if ($signature->verifyDOMDocument($decryptedDocument) == false) {
            throw new \Exception('Could not verify Signature');
        }

        return $decryptedDocument;
    }

    public function setContainer($container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }
}
