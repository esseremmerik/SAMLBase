<?php

namespace Wizkunde\SAML2PHP\Template;

class Template extends \Twig_Environment
{
    public function renderFile($file, $variables)
    {
        $loader = new \Twig_Loader_Filesystem('/');
        $twig = new \Twig_Environment($loader);

        $this->render($file, $variables);
    }
}