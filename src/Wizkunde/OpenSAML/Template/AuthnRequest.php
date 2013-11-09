<?php

namespace Wizkunde\OpenSAML\Template;

use Wizkunde\OpenSAML\Template\TeplateAbstract;
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
        $request = <<<AUTHNREQUEST
<samlp:AuthnRequest
    xmlns:samlp="urn:oasis:names:tc:SAML:2.0:protocol"
    xmlns:saml="urn:oasis:names:tc:SAML:2.0:assertion"
    ID="$this->uniqueId"
    Version="2.0"
    IssueInstant="$this->timestamp"
    ProtocolBinding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect"
    AssertionConsumerServiceURL="{$this->getConfiguration()->getSpReturnURL()}">
    <saml:Issuer>{$this->getConfiguration()->getIssuer()}</saml:Issuer>
    <samlp:NameIDPolicy
        Format="{$this->getConfiguration()->getNameIdFormat()}"
        AllowCreate="true"></samlp:NameIDPolicy>
    <samlp:RequestedAuthnContext Comparison="{$this->getConfiguration()->getComparisonLevel()}">
        <saml:AuthnContextClassRef>
            urn:oasis:names:tc:SAML:2.0:ac:classes:PasswordProtectedTransport
        </saml:AuthnContextClassRef>
    </samlp:RequestedAuthnContext>
</samlp:AuthnRequest>
AUTHNREQUEST;

        $deflatedRequest = gzdeflate($request);
        $base64Request = base64_encode($deflatedRequest);
        $encodedRequest = urlencode($base64Request);

        return 'http://idp.wizkunde.nl/simplesaml/saml2/idp/SSOService.php' . "?SAMLRequest=" . $encodedRequest;
    }
}
