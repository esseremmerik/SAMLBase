<?php

namespace Wizkunde\SAML2PHP\Storage;

use Wizkunde\SAML2PHP\Configuration;
use Wizkunde\SAML2PHP\ConfigurationTrait;
use Wizkunde\SAML2PHP\Storage\Persistence\PersistenceInterface;

class Storage
{
    use ConfigurationTrait;

    /**
     * Storage adapter to be used for persistence
     *
     * @var null
     */
    protected $adapter = null;

    public function __construct(Configuration $configuration)
    {
        $this->setConfiguration($configuration);
    }

    /**
     * Get the persistence adapter
     *
     * @param PersistenceInterface $adapter
     */
    public function setAdapter(PersistenceInterface $adapter)
    {
        $this->adapter = $adapter;
        $this->adapter->setConfiguration($this->getConfiguration());
    }

    /**
     * Set the persistence adapter
     *
     * @return null
     */
    public function getAdapter()
    {
        return $this->adapter;
    }

    /**
     * Persist the data to the adapter
     *
     * @param \DOMDocument $document
     */
    public function persist(\DOMDocument $document)
    {
        if ($element = $document->xpath('//saml:AuthnStatement')) {
            $data = array(
                'Token' => (string)$element->attributes()->SessionIndex,
                'Validity' => (string)$element->attributes()->SessionNotOnOrAfter
            );
        }

        var_dump($data);
        die;
    }
}