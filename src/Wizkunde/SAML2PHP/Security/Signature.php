<?php

namespace Wizkunde\SAML2PHP\Security;

use Wizkunde\SAML2PHP\ConfigurationTrait;

class Signature extends \XMLSecurityDSig
{
    use ConfigurationTrait;

    public function verifyDOMDocument($document)
    {
        $signatureNode = $this->locateSignature($document);

        /**
         * No signature was added, it should not fail as this is not a requirement on redirect bindings
         */
        if (!$signatureNode) {
            return true;
        }

        $this->setCanonicalMethod(self::C14N);
        $this->addReference($document, $this->getConfiguration()->get('SigningAlgorithm'), array('http://www.w3.org/2000/09/xmldsig#enveloped-signature', XMLSecurityDSig::C14N), array('force_uri' => true));
    }
}