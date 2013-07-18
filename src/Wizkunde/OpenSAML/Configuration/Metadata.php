<?php

namespace Wizkunde\OpenSAML\Configuration;

use Wizkunde\OpenSAML\Configuration;

class Metadata implements MetadataInterface
{
    /**
     * @var Wizkunde\OpenSAML\Configuration
     */
    protected $configuration = null;

    /**
     * @param Configuration $configuration
     * @return mixed
     */
    public function construct(Configuration $configuration)
    {
        $this->configuration = $configuration;
    }

    /**
     * @todo separation of concerns, we dont want to keep this template in this position
     * @todo some of these template settings like AssertionConsumerService needs to be configurable
     * @return string with xml data
     */
    public function getMetadata()
    {
        return <<<METADATA_TEMPLATE
<?xml version="1.0"?>
<md:EntityDescriptor xmlns:md="urn:oasis:names:tc:SAML:2.0:metadata"
                     validUntil="{$this->getMetadataTimestamp()}"
                     entityID="{$this->configuration->getIssuer()}">
    <md:SPSSODescriptor protocolSupportEnumeration="urn:oasis:names:tc:SAML:2.0:protocol">
        <md:NameIDFormat>{$this->configuration->getNameIdFormat()}</md:NameIDFormat>
        <md:AssertionConsumerService Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST"
                                     Location="{$this->configuration->getSpReturnUrl()}"
                                     index="1"/>
    </md:SPSSODescriptor>
</md:EntityDescriptor>
METADATA_TEMPLATE;
    }

    /**
     * @todo do this with the intl extension possibly?
     *
     * @return string Get a valid timestamp
     */
    protected function getMetadataTimestamp()
    {
        $timeZone = date_default_timezone_get();
        date_default_timezone_set('UTC');
        $time = strftime("%Y-%m-%dT%H:%M:%SZ", time() + self::VALIDITY_SECONDS);
        date_default_timezone_set($timeZone);
        return $time;
    }
}