<?php

namespace Wizkunde\SAML2PHP\Metadata;

/**
 * This class automatically maps IDP metadata to the designated values
 *
 * Class Metadata
 * @package Wizkunde\SAML2PHP\Metadata
 */
abstract class MetadataAbstract
{
    /**
     * Contains the metadata for every mapping needed in subclasses of this class
     *
     * @var array
     */
    protected $xpathMappings = array();

    /**
     * @var \DOMDocument that contains the unmapped metadata
     */
    protected $document = null;

    /**
     * Current Metadata from source
     *
     * @var array
     */
    protected $metadata = array();

    /**
     * Sign methods
     */
    const SIGN_SHA1 = 'http://www.w3.org/2000/09/xmldsig#sha1';
    const SIGN_SHA256 = 'http://www.w3.org/2000/09/xmldsig#sha256';

    /**
     * Initialize and possibly automatically map the metadata
     *
     * @param string $metadata
     */
    public function __construct($metadata = '')
    {
        if ($metadata != '') {
            $this->mapMetadata($metadata);
        }
    }

    /**
     * Get the mapped metadata
     *
     * @return array
     */
    public function getMetadata()
    {
        return $this->metadata;
    }

    /**
     * Map a new metadata xml document
     *
     * @param $metadata
     */
    public function mapMetadata($metadata)
    {
        $this->metadata = new \SimpleXMLElement($metadata);

        $mappings = array();
        foreach ($this->xpathMappings as $namespace => $xpathMappings) {
            foreach ($xpathMappings as $query => $mapping) {
                $data = current($this->metadata->xpath($query));

                if (is_array($mapping)) {
                    if (isset($mapping['Attributes'])) {
                        foreach ($mapping['Attributes'] as $attribute => $mappedAttribute) {
                            if (is_object($data)) {
                                $mappings[$namespace][$mappedAttribute] = (string)$data->attributes()->$attribute;
                            }
                        }
                    }

                    if (array_key_exists('Value', $mapping)) {
                        if (is_object($data)) {
                            $mappings[$namespace][$mapping['Value']] = (string)$data;
                        }
                    }
                } else {
                    if (is_object($data)) {
                        $mappings[$namespace][$mappedAttribute] = (string)$data;
                    }
                }
            }
        }

        return $mappings;
    }
}