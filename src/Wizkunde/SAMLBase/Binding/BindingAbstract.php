<?php

namespace Wizkunde\SAMLBase\Binding;

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

    public function buildRequest($requestType = 'AuthnRequest')
    {
        $requestTemplate = $this->getContainer()->get('twig')->render($requestType . '.xml.twig',
            array(
                'ProtocolBinding' => $this->getProtocolBinding(),
                'UniqueID' => $this->getContainer()->get('samlbase_unique_id_generator')->generate(),
                'Timestamp' => $this->getContainer()->get('samlbase_timestamp_generator')->generate()->toFormat(),
                'ForceAuthn' => $this->getContainer()->getParameter('ForceAuthn'),
                'IsPassive' => $this->getContainer()->getParameter('IsPassive'),
                'SPReturnUrl' => $this->getContainer()->getParameter('SPReturnUrl'),
                'NameIDFormat' => $this->getContainer()->getParameter('NameIDFormat'),
                'Issuer' => $this->getContainer()->getParameter('Issuer'),
                'ComparisonLevel' => $this->getContainer()->getParameter('ComparisonLevel')
            )
        );

        $signedTemplate = $this->signTemplate($requestTemplate);
        return $this->prepareTemplateForRequest($signedTemplate);
    }

    protected function signTemplate($template)
    {
        $document = new \DOMDocument();
        $document->loadXML($template);

        $this->getContainer()->get('samlbase_signature')->addSignature($document);

        return $document->saveXML();
    }

    protected function prepareTemplateForRequest($template)
    {
        $deflatedRequest = gzdeflate($template);
        $base64Request = base64_encode($deflatedRequest);
        $encodedRequest = urlencode($base64Request);

        return $encodedRequest;
    }
}
