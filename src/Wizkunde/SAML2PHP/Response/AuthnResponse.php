<?php

namespace Wizkunde\SAML2PHP\Response;

use Wizkunde\SAML2PHP\Configuration;
use Wizkunde\SAML2PHP\ConfigurationTrait;
use Wizkunde\SAML2PHP\Security\Encryption;
use Wizkunde\SAML2PHP\Security\Signature;

class AuthnResponse
{
    use ConfigurationTrait;

    /**
     * Initialize the class with the configuration
     *
     * @param Configuration $configuration
     */
    public function __construct(Configuration $configuration)
    {
        $this->setConfiguration($configuration);
    }

    /**
     * Handle the response string that we receive
     *
     * @param $response
     */
    public function decode($response)
    {
        $responseData = base64_decode($response);

        $encryption = new Encryption();
        $decryptedDocument = $encryption->decrypt($responseData, $this->getConfiguration()->get('EncryptionCertificate'));

        $signature = new Signature();
        $signature->setConfiguration($this->getConfiguration());
        if ($signature->verifyDOMDocument($decryptedDocument) == false) {
            throw new \Exception('Could not verify Signature');
        }

        return $decryptedDocument;
    }
}
