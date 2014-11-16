<?php

namespace Wizkunde\SAML2PHP\Binding;

use Wizkunde\SAML2PHP\Binding\BindingAbstract;
use Wizkunde\SAML2PHP\Configuration;
use Wizkunde\SAML2PHP\Security\Signature;
use Wizkunde\SAML2PHP\Template\AuthnRequest as RequestTemplate;
use Wizkunde\SAML2PHP\Template\Template;

/**
 * Class Redirect
 *
 * Redirect binding that uses HTTP-GET as a transport for a SAML request
 *
 * @package Wizkunde\SAML2PHP\Binding
 */
class Redirect extends BindingAbstract
{
    /**
     * The location in the metadata that has the current bindings information
     * @var string
     */
    protected $metadataBindingLocation = 'SSORedirect';

    /**
     * Do a request with the current binding
     */
    public function request()
    {
        parent::request();

        $this->setProtocolBinding(self::BINDING_REDIRECT);

        $redirectUrl = $this->buildRedirectUrl();
        header('Location: ' . (string)$redirectUrl);
    }

    /**
     * Build the Redirect URL, using the template thats provided
     * @return RequestTemplate
     */
    protected function buildRedirectUrl()
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

        return $this->getTargetUrl() . '?SAMLRequest=' . $encodedRequest;
    }
}
