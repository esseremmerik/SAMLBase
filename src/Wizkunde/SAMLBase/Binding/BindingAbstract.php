<?php

namespace Wizkunde\SAMLBase\Binding;

use Wizkunde\SAMLBase\Configuration\Settings;
use Wizkunde\SAMLBase\Configuration\Timestamp;
use Wizkunde\SAMLBase\Configuration\UniqueID;

abstract class BindingAbstract implements BindingInterface
{
    const BINDING_REDIRECT = 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect';
    const BINDING_POST = 'urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST';

    protected $signatureService = null;
    protected $twigService = null;
    protected $uniqueIdService = null;
    protected $timestampService = null;

    /**
     * @var Binding that we use for the current protocol
     */
    protected $protocolBinding = null;

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

    /**
     * Set the settings used for the connection
     *
     * @var array
     */
    protected $settings = null;

    /**
     * @return array
     */
    public function getSettings()
    {
        return $this->settings;
    }

    /**
     * @return null
     */
    public function getSignatureService()
    {
        return $this->signatureService;
    }

    /**
     * @param null $signatureService
     */
    public function setSignatureService($signatureService)
    {
        $this->signatureService = $signatureService;
    }

    /**
     * @return null
     */
    public function getTwigService()
    {
        return $this->twigService;
    }

    /**
     * @param null $twigService
     */
    public function setTwigService($twigService)
    {
        $this->twigService = $twigService;
    }

    /**
     * @return null
     */
    public function getUniqueIdService()
    {
        return $this->uniqueIdService;
    }

    /**
     * @param null $uniqueIdService
     */
    public function setUniqueIdService(UniqueID $uniqueIdService)
    {
        $this->uniqueIdService = $uniqueIdService;
    }

    /**
     * @return null
     */
    public function getTimestampService()
    {
        return $this->timestampService;
    }

    /**
     * @param null $timestampService
     */
    public function setTimestampService(Timestamp $timestampService)
    {
        $this->timestampService = $timestampService;
    }


    /**
     * @param array $settings
     */
    public function setSettings(Settings $settings)
    {
        $this->settings = $settings;

        return $this;
    }

    public function setMetadata($metadata)
    {
        $this->metadata = $metadata;

        return $this;
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

        return $this;
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

    public function setProtocolBinding($binding)
    {
        $this->protocolBinding = $binding;

        return $this;
    }

    public function getProtocolBinding()
    {
        return $this->protocolBinding;
    }

    public function buildRequest($requestType = 'AuthnRequest')
    {
        $requestTemplate = $this->getTwigService()->render($requestType . '.xml.twig',
            array(
                'ProtocolBinding' => $this->getProtocolBinding(),
                'UniqueID' => $this->getUniqueIdService()->generate(),
                'Timestamp' => $this->getTimestampService()->generate()->toFormat(),
                'ForceAuthn' => $this->getSettings()->getValue('ForceAuthn'),
                'IsPassive' => $this->getSettings()->getValue('IsPassive'),
                'SPReturnUrl' => $this->getSettings()->getValue('SPReturnUrl'),
                'NameIDFormat' => $this->getSettings()->getValue('NameIDFormat'),
                'Issuer' => $this->getSettings()->getValue('Issuer'),
                'ComparisonLevel' => $this->getSettings()->getValue('ComparisonLevel')
            )
        );

        $signedTemplate = $this->signTemplate($requestTemplate);

        return $this->prepareTemplateForRequest($signedTemplate);
    }

    protected function signTemplate($template)
    {
        $document = new \DOMDocument();
        $document->loadXML($template);

        $this->getSignatureService()->addSignature($document);

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
