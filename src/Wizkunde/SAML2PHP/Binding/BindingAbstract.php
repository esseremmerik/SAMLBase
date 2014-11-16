<?php

namespace Wizkunde\SAML2PHP\Binding;

abstract class BindingAbstract implements BindingInterface
{
    const BINDING_REDIRECT = 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect';
    const BINDING_POST = 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST';

    /**
     * @var Binding that we use for the current protocol
     */
    protected $protocolBinding = null;

    /**
     * Contains the dependency injection container
     *
     * @var null
     */
    protected $container = null;

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

    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;
    }

    /**
     * Do a request with the current binding
     */
    public function setTargetUrlFromMetadata()
    {
        if ($this->metadataBindingLocation == '' || !isset($this->metadata[$this->metadataBindingLocation])) {
            throw new \Exception('Cant initialize binding, no SingleSignOn binding information is known for the current binding');
        }

        $this->targetUrl = $this->metadata[$this->metadataBindingLocation]['Location'];
    }

    /**
     * @return target URL of our request
     */
    public function getTargetUrl()
    {
        return $this->targetUrl;
    }

    /**
     * Mandatory steps for all request binding subcalls
     */
    public function request()
    {
        $this->setTargetUrlFromMetadata();
    }

    public function setContainer($container)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }

    public function setProtocolBinding($binding)
    {
        $this->protocolBinding = $binding;
    }

    public function getProtocolBinding()
    {
        return $this->protocolBinding;
    }

    public function buildAuthnRequest()
    {
        $requestTemplate = $this->getContainer()->get('twig')->render('AuthnRequest.xml.twig',
            array(
                'ProtocolBinding' => $this->getProtocolBinding(),
                'UniqueID' => $this->getContainer()->get('unique_id_generator')->generate(),
                'Timestamp' => $this->getContainer()->get('timestamp_generator')->generate()->toFormat(),
                'ForceAuthn' => $this->getContainer()->getParameter('ForceAuthn'),
                'IsPassive' => $this->getContainer()->getParameter('IsPassive'),
                'SPReturnUrl' => $this->getContainer()->getParameter('SPReturnUrl'),
                'NameIDFormat' => $this->getContainer()->getParameter('NameIDFormat'),
                'Issuer' => $this->getContainer()->getParameter('Issuer'),
                'ComparisonLevel' => $this->getContainer()->getParameter('ComparisonLevel')
            )
        );

        $document = new \DOMDocument();
        $document->loadXML($requestTemplate);

        $this->getContainer()->get('signature')->addSignature($document);

        $deflatedRequest = gzdeflate($document->saveXML());
        $base64Request = base64_encode($deflatedRequest);
        $encodedRequest = urlencode($base64Request);

        return $encodedRequest;
    }
}
