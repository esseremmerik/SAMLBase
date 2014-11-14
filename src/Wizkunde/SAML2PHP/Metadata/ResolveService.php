<?php

namespace Wizkunde\SAML2PHP\Metadata;

use Wizkunde\SAML2PHP\Configuration;
use GuzzleHttp\Client;

use Wizkunde\SAML2PHP\ConfigurationTrait;
use Wizkunde\SAML2PHP\Metadata\MetadataAbstract;

class ResolveService
{
    /**
     * Initialize the resolver service
     *
     * @param Configuration $configuration
     */
    public function __construct(Client $client)
    {
        $this->setClient($client);
    }

    /**
     * Resolve the metadata
     */
    public function resolve(MetadataAbstract $metadataClass, $metadataUrl)
    {
        $response = $this->getClient()->get($metadataUrl);
        $xmlDocument = (string) $response->getBody();

        return $metadataClass->mapMetadata($xmlDocument);
    }

    /**
     * Set the client for fetching the metadata
     *
     * @param Client $client
     */
    public function setClient(Client $client)
    {
        $this->client = $client;
    }

    /**
     * Get the client for fetching the metadata
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }
}