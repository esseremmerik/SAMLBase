<?php

namespace Wizkunde\SAML2PHP\Binding;

use Wizkunde\SAML2PHP\Binding\BindingAbstract;

/**
 * Class Post
 *
 * Post binding that uses HTTP-POST as a transport for a SAML Request
 *
 * @package Wizkunde\SAML2PHP\Binding
 */
class Post extends BindingAbstract
{
    /**
     * Do a request with the current binding
     */
    public function request()
    {

    }

    /**
     * Build a post request to be sent over POST
     */
    protected function buildPostRequest()
    {

    }
}
