<?php

namespace Wizkunde\SAML2PHP\Storage\Persistence;

interface PersistenceInterface
{
    public function persist($data);
}