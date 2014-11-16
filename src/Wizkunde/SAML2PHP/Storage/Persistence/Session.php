<?php

namespace Wizkunde\SAML2PHP\Storage\Persistence;

use Wizkunde\SAML2PHP\Security\Encryption;

class Session implements PersistenceInterface
{
    public function persist($data)
    {
        $encryption = new Encryption();

        $encryptedToken = $encryption->encrypt($data['Token'], $this->getConfiguration()->get('EncryptionCertificate')->getPrivateKey());
        var_dump($encryptedToken);
    }
}