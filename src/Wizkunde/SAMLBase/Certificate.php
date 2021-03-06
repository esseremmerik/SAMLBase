<?php

namespace Wizkunde\SAMLBase;

class Certificate
{
    protected $publicKey = null;
    protected $privateKey = null;
    protected $passphrase = '';

    protected $type = \XMLSecurityKey::RSA_SHA1;

    /**
     * Set the passphrase to unlock the private key
     *
     * @param $passphrase
     */
    public function setPassphrase($passphrase)
    {
        $this->passphrase = $passphrase;
    }

    /**
     * Get the passphrase to unlock the private key
     * @return string
     */
    public function getPassphrase()
    {
        return $this->passphrase;
    }

    /**
     * Set the public key for this certificate
     *
     * @param $publicKey
     * @throws \Exception
     */
    public function setPublicKey($publicKey, $isFile = false, $type = \XMLSecurityKey::RSA_SHA1, $params = array())
    {
        $this->publicKey = new \XMLSecurityKey($type, array_merge($params, array('type' => 'public')));
        $this->publicKey->loadKey($publicKey, $isFile);

        $this->certificate = $publicKey;
    }

    /**
     * Load the private key for this certificate
     *
     * @return mixed
     */
    public function getPublicKey()
    {
        return $this->publicKey;
    }

    /**
     * Set the private key for this certificate
     *
     * @param $privateKey
     * @throws \Exception
     */
    public function setPrivateKey($privateKey, $isFile = false, $type = \XMLSecurityKey::RSA_SHA1, $params = array())
    {
        $this->privateKey = new \XMLSecurityKey($type, array_merge($params, array('type' => 'private')));

        if ($this->passphrase != '') {
            $this->privateKey->passphrase = $this->passphrase;
        }

        $this->privateKey->loadKey($privateKey, $isFile);
    }

    public function getPrivateKey()
    {
        return $this->privateKey;
    }

    /**
     * @return null|string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param null|string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }
}