<?php

namespace Wizkunde\SAML2PHP;

class Certificate
{
    protected $publicKey = null;
    protected $privateKey = null;
    protected $passphrase = '';

    protected $type = \XMLSecurityKey::RSA_SHA1;

    /**
     * Create a new Certificate
     *
     * Defaults to RSA_SHA1 cert
     *
     * @param string $type
     * @param null $params
     * @throws \Exception
     */
    public function __construct($privateKey, $publicKey, $passphrase = '', $type = \XMLSecurityKey::RSA_SHA1)
    {
        $this->setType($type);

        if ($passphrase != '') {
            $this->setPassphrase($passphrase);
        }

        $this->setPrivateKey($privateKey);
        $this->setPublicKey($publicKey);
    }

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
    public function setPublicKey($publicKey, $params = array())
    {
        $this->publicKey = new \XMLSecurityKey($this->getType(), array_merge($params, array('type' => 'public')));
        $this->publicKey->loadKey($publicKey);

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
    public function setPrivateKey($privateKey, $params = array())
    {
        $this->privateKey = new \XMLSecurityKey($this->getType(), array_merge($params, array('type' => 'private')));

        if ($this->passphrase != '') {
            $this->privateKey->passphrase = $this->passphrase;
        }

        $this->privateKey->loadKey($privateKey);
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