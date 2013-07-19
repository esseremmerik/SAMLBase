<?php

namespace Wizkunde\OpenSAML\Template;

use Wizkunde\OpenSAML\Template\TeplateAbstract;
use Wizkunde\OpenSAML\Configuration\Timestamp;

class Metadata extends TemplateAbstract
{
    public function __toString()
    {
        $timestamp = new Timestamp();
        $timestamp->add(Timestamp::SECONDS_WEEK);

        // @todo some of these template settings like AssertionConsumerService needs to be configurable

        $template = <<<METADATA_TEMPLATE
<?xml version="1.0"?>
<md:EntityDescriptor xmlns:md="urn:oasis:names:tc:SAML:2.0:metadata"
                     validUntil="{$timestamp}"
                     entityID="{$this->configuration->getIssuer()}">
    <md:SPSSODescriptor protocolSupportEnumeration="urn:oasis:names:tc:SAML:2.0:protocol">
        <md:NameIDFormat>{$this->configuration->getNameIdFormat()}</md:NameIDFormat>
        <md:AssertionConsumerService Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST"
                                     Location="{$this->configuration->getSpReturnUrl()}"
                                     index="1"/>
    </md:SPSSODescriptor>
</md:EntityDescriptor>
METADATA_TEMPLATE;

        return $template;
    }
}