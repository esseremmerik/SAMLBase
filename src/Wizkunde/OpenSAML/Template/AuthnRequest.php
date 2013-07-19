<?php

namespace Wizkunde\OpenSAML\Template;

use Wizkunde\OpenSAML\Configuration\TeplateAbstract;
use Wizkunde\OpenSAML\Configuration\UniqueID;
use Wizkunde\OpenSAML\Configuration\Timestamp;

/**
 * Class Request
 *
 * Template for the AuthnRequest
 *
 * @package Wizkunde\OpenSAML\Template
 */
class AuthnRequest extends TemplateAbstract
{
    public function __toString()
    {
        $id = new UniqueID();
        $timestamp = new Timestamp();

        $request = <<<AUTHNREQUEST
<samlp:AuthnRequest
    xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"
    xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"
    ID="$id"
    Version="2.0"
    IssueInstant="$timestamp"
    ProtocolBinding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect"
    AssertionConsumerServiceURL="{$this->configuration->getSPReturnURL()}">
    <saml:Issuer>{$this->configuration->getIssuer()}</saml:Issuer>
    <samlp:NameIDPolicy
        Format="{$this->configuration->getNameIdFormat()}"
        AllowCreate="true"></samlp:NameIDPolicy>
    <samlp:RequestedAuthnContext Comparison="{$this->configuration->getComparisonLevel()}">
        <saml:AuthnContextClassRef>urn:oasis:names:tc:SAML:2.0:ac:classes:PasswordProtectedTransport</saml:AuthnContextClassRef>
    </samlp:RequestedAuthnContext>
</samlp:AuthnRequest>
AUTHNREQUEST;

        $deflatedRequest = gzdeflate($request);
        $base64Request = base64_encode($deflatedRequest);
        $encodedRequest = urlencode($base64Request);

        return $this->configuration->getIdpMetadataUrl() . "?SAMLRequest=" . $encodedRequest;
    }
}