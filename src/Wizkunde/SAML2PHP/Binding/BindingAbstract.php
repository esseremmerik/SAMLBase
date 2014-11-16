<?php

namespace Wizkunde\SAML2PHP\Binding;

use Wizkunde\SAML2PHP\Binding\BindingInterface;
use Wizkunde\SAML2PHP\ConfigurationTrait;
use Wizkunde\SAML2PHP\Security\Signature;

abstract class BindingAbstract implements BindingInterface
{
    const BINDING_REDIRECT = 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect';
    const BINDING_POST = 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST';

    /**
     * The location in the metadata that has the current bindings information
     * @var string
     */
    protected $metadataBindingLocation = '';

    /**
     * The metadata thats used for the binding
     *
     * @var array
     */
    protected $metadata = array();

    /**
     * @var target URL for our request
     */
    protected $targetUrl = null;

    // Allow the use of configuration
    use ConfigurationTrait;

    public function setMetadata($metadata) {
        $this->metadata = $metadata;
    }

    /**
     * Do a request with the current binding
     */
    public function setTargetUrlFromMetadata()
    {
        if($this->metadataBindingLocation == '' || !isset($this->metadata[$this->metadataBindingLocation])) {
            throw new \Exception('Cant initialize binding, no SingleSignOn binding information is known for the current binding');
        }

        $this->targetUrl = $this->metadata[$this->metadataBindingLocation]['Location'];
    }

    /**
     * Add the signature to the template
     *
     * @param \DOMElement $element
     * @return bool
     * @throws \Exception
     */
    public function addSignature(\DOMElement $element)
    {
        $objKey = $this->getConfiguration()->get('SigningCertificate')->getPrivateKey();

        $sign = new Signature();
        $sign->setCanonicalMethod(\XMLSecurityDSig::EXC_C14N_COMMENTS);
        $sign->addReference($element, \XMLSecurityDSig::SHA1, array('http://www.w3.org/2000/09/xmldsig#enveloped-signature'));
        $sign->add509Cert($this->getConfiguration()->get('SigningCertificate')->getPublicKey());
        $sign->sign($objKey, $element);

        return true;
    }

    /**
     * @return target URL of our request
     */
    public function getTargetUrl() {
        return $this->targetUrl;
    }

    /**
     * Mandatory steps for all request binding subcalls
     */
    public function request()
    {
        $this->setTargetUrlFromMetadata();
    }
}
