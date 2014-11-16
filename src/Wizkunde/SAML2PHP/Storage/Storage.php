<?php

namespace Wizkunde\SAML2PHP\Storage;

use Wizkunde\SAML2PHP\Storage\Persistence\PersistenceInterface;

class Storage
{

    /**
     * Storage adapter to be used for persistence
     *
     * @var null
     */
    protected $adapter = null;

    /**
     * Get the persistence adapter
     *
     * @param PersistenceInterface $adapter
     */
    public function setAdapter(PersistenceInterface $adapter)
    {
        $this->adapter = $adapter;
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