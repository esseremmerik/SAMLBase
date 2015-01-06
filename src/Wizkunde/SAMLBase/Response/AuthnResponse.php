<?php

namespace Wizkunde\SAMLBase\Response;

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

        $decryptedDocument = $this->getContainer()->get('samlbase_encryption')->decrypt($responseData);

        if ($this->getContainer()->get('samlbase_signature')->verifyDOMDocument($decryptedDocument) == false) {
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
