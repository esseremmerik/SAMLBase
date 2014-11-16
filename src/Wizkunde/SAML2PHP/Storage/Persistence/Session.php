<?php

namespace Wizkunde\SAML2PHP\Storage\Persistence;

use Wizkunde\SAML2PHP\ConfigurationTrait;
use Wizkunde\SAML2PHP\Security\Encryption;

class Session implements PersistenceInterface
{
    use ConfigurationTrait;

    public function persist($data) {
        $encryption = new Encryption();
        $encryption->setConfiguration($this->getConfiguration());

        var_dump($data['Token']);
        $encryptedToken = $encryption->encrypt($data['Token'], $this->getConfiguration()->get('EncryptionCertificate')->getPrivateKey());
        var_dump($encryptedToken);
    }
}