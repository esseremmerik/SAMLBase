<?php

namespace Wizkunde\SAML2PHP\Claim;

class Attributes
{
    public function getAttributes($document)
    {
        $element = simplexml_load_string($document->version);

        $attributes = array();
        foreach ($element->xpath('//saml:AttributeStatement/saml:Attribute') as $attribute) {
            $attributes[(string)$attribute->attributes()->Name] = (string)current($attribute->xpath('saml:AttributeValue'));
        }

        return $attributes;
    }
}