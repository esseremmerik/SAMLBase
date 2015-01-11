<?php

namespace Wizkunde\SAMLBase\Metadata;

use Wizkunde\SAMLBase\Binding\Redirect;

class IDPMetadata extends MetadataAbstract
{
    /**
     * Mappings from the Identity Provider
     * @var array
     */
    protected $xpathMappings = array(
        'Signature' => array(
            '//ds:Signature/ds:SignedInfo/ds:SignatureMethod' => array(
                'Attributes' => array(
                    'Algorithm' => 'SigningMethod'
                ),
            ),

            '//ds:Signature/ds:SignatureValue' => array(
                'Value' => 'Signature'
            ),

            '//ds:Signature/ds:KeyInfo/ds:X509Data/ds:X509Certificate' => array(
                'Value' => 'Certificate'
            ),
        ),
        'Encryption' => array(
            '//ds:Signature/ds:SignedInfo/ds:Reference/ds:DigestMethod' => array(
                'Attributes' => array(
                    'Algorithm' => 'DigestMethod'
                ),
            ),
            // Digest Value of the digest we made
            '//ds:Signature/ds:SignedInfo/ds:Reference/ds:DigestValue' => array(
                'Value' => 'DigestValue'
            ),
        ),

        'Metadata' => array(
            '//md:IDPSSODescriptor' => array(
                'Attributes' => array(
                    'protocolSupportEnumeration' => 'Protocol'
                )
            ),

            '//md:IDPSSODescriptor/md:NameIDFormat' => array(
                'Value' => 'NameIDFormat'
            ),

            '//md:IDPSSODescriptor/md:KeyDescriptor[@use="signing"]/ds:KeyInfo/ds:X509Data/ds:X509Certificate' => array(
                'Value' => 'SignCertificate'
            ),

            '//md:IDPSSODescriptor/md:KeyDescriptor[@use="encryption"]/ds:KeyInfo/ds:X509Data/ds:X509Certificate' => array(
                'Value' => 'EncryptionCertificate'
            ),
        ),

        'SingleLogoutService' => array(
            '//md:IDPSSODescriptor/md:SingleLogoutService' => array(
                'Attributes' => array(
                    'Binding' => 'Binding',
                    'Location' => 'Location'
                ),
                'Multiple' => true
            ),
        ),

        'ArtifactResolutionService' => array(
            '//md:IDPSSODescriptor/md:ArtifactResolutionService' => array(
                'Attributes' => array(
                    'Binding' => 'Binding',
                    'Location' => 'Location'
                ),
                'Multiple' => true
            ),
        ),

        'SingleSignOnServiceRedirect' => array(
            '//md:IDPSSODescriptor/md:SingleSignOnService[@Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-Redirect"]' => array(
                'Attributes' => array(
                    'Binding' => 'Binding',
                    'Location' => 'Location'
                ),
                'Multiple' => true
            )
        ),

        'SingleSignOnServicePost' => array(
            '//md:IDPSSODescriptor/md:SingleSignOnService[@Binding="urn:oasis:names:tc:SAML:2.0:bindings:HTTP-POST"]' => array(
                'Attributes' => array(
                    'Binding' => 'Binding',
                    'Location' => 'Location'
                ),
                'Multiple' => true
            )
        )


    );
}