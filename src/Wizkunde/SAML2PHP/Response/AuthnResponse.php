<?php

namespace Wizkunde\SAML2PHP\Response;

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

        $decryptedDocument = $this->getContainer()->get('encryption')->decrypt($responseData);

        if ($this->getContainer()->get('signature')->verifyDOMDocument($decryptedDocument) == false) {
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
